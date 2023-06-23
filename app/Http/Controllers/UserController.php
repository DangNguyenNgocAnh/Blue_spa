<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Mail\SendMail;
use App\Models\Apointment;
use App\Models\Department;
use App\Models\User;
use App\Rules\HaveApointmentRule;
use App\Rules\QuantityLimitRule;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function getFormRegister()
    {
        return view('user.view.register', [
            'tittle' => 'Register'
        ]);
    }
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create(array_merge($request->except('confPass'), [
                'code' => User::max('code') + 1,
                'department_id' => Department::where('name', 'Customer')->first()->id,
                'level' => 'Level 1'
            ]));
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('user.dashboard')->with('success', 'Bạn đã đăng ký tài khoản thành công !');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
    public function show()
    {
        return view('user.view.profile', [
            'tittle' => 'My Profile',
            'user' => Auth::user(),
            'packages' => []
        ]);
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->currentPass, $user->password)) {
            try {
                $user->password = Hash::make($request->newPass);
                $user->save();
                return redirect()->back()->with('success', 'Update password success');
            } catch (Exception $ex) {
                return redirect()->back()->with('failed', $ex->getMessage());
            }
        }
        $errors = new MessageBag();
        $errors->add('currentPass', 'Password is incorrect');
        return redirect()->back()->withErrors($errors);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:50',
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(request()->id)],
            'password' =>  'nullable|max:25|min:8',
            'phone_number' => ["required", "numeric", "regex:/^([0-9\s\-\+\(\)]*)$/", "min:9", Rule::unique('users')->ignore(request()->id)],
            'day_of_birth' => 'required|date|before:today|after:' . now()->subYears(100)->format('Y-m-d'),
            'address' => 'nullable|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find(Auth::user()->id);
        try {
            $user->fill($request->all());
            $user->save();
            return redirect()->back()->with('success', 'Update success');
        } catch (Exception $ex) {
            return redirect()->back()->with('failed', $ex->getMessage());
        }
    }
    public function makeApointment()
    {
        return view(
            'user.view.makeApointment',
            [
                'tittle' => 'Make a apointment',
                'staffs' => User::whereHas('department', function ($query) {
                    $query->where('name', 'Staff');
                })->get(),
                'maxDay' => now()->addDays(7)->format('Y-m-d'),
                'minDay' => now()->format('Y-m-d'),
            ]
        );
    }
    public function createApointment(Request $request)
    {
        $user = Auth::user();
        $apointment_time = ($request->minute)
            ? DateTime::createFromFormat('Y-m-d H:i', "$request->date $request->hour:$request->minute")
            : DateTime::createFromFormat('Y-m-d H:i', "$request->date $request->hour:00");
        if ($request->date == now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')) {
            $rule_hour =  [
                'required', 'date_format:H',
                'after:' . now()->setTimezone('Asia/Ho_Chi_Minh')->format('H')
            ];
        } else {
            $rule_hour =  ['required'];
        }
        $validator = Validator::make($request->all(), [
            'hour' => $rule_hour,
            'date' => [
                new QuantityLimitRule(Apointment::where('time', $apointment_time)->count()),
                new HaveApointmentRule($user->apointments()->whereDate('time', $request->date)->whereNot('status', 'Cancelled')->count())
            ]

        ], [
            'hour.after' => 'The hour must be after the current time',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            Apointment::create(
                [
                    'code' => Apointment::max('code') + 1,
                    'customer_id' => Auth::id(),
                    'employee_id' => $request->employee_id ?? null,
                    'time' => $apointment_time,
                    'status' => 'Confirmed',
                    'message' => $request->message
                ]
            );
            return redirect()->route('user.showAllPackage')->with('success', 'Make a apointment successfull ! ');
        } catch (Exception $ex) {
            return redirect()->back()->with('failed', 'Error');
        }
    }
    public function showAllPackage()
    {
        $user = User::find(Auth::id());
        return view('user.view.listApointmentPackage', [
            'tittle' => 'List Apointment',
            'user' => $user,
            'packages' => $user->packages()->paginate(10),
            'apointments' => $user->apointments()->paginate(10)
        ]);
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $user = User::where('email', $request->emailReset)->first();
            $randPass = Str::random(15);
            if (!$this->sendMailConfirm($user, $randPass) || (!$user)) {
                return redirect()->back()->with('failed', 'Đã có lỗi xảy ra, vui lòng thử lại !');
            };
            $user->password = Hash::make($randPass);
            $user->save();
            return redirect()->back()->with('success', 'Đã gửi mail, vui lòng xác nhận !');
        } catch (Exception $ex) {
            return redirect()->back()->with('failed', 'Đã có lỗi xảy ra, vui lòng thử lại !');
        }
    }
    public function sendMailConfirm(User $user, String $random)
    {
        try {
            $mailData = [
                'from' => env('MAIL_USERNAME'),
                'to' => $user->email,
                'subject' => 'Reset Password',
                'data' => [
                    'header' => "Xin chào <b>$user->fullname.</b>",
                    'body' =>
                    "<p>Chúng tôi là <b>Blue spa team</b>, bạn vừa yêu cầu reset mật khẩu tại trang web của chúng tôi .</p>
                    <p>Tài khoản của bạn đã được reset password lại thành <b>$random</b>.</p>
                     <p>Vui lòng đăng nhập lại với password như trên và đổi lại mật khẩu nếu muốn.</p>",
                    'footer' =>
                    " <p>Nếu có gì thắc mắc xin vui lòng liên hệ với chúng tôi thông qua:</p>
                    <ul>
                    <li> số điện thoại: <b>0702751033</b></li>
                    <li> email: <b>bluespa.admin@gmail.com</b></li>
                    <li> Địa chỉ trang web: <b><a href ='http://spa.test/'> Blue spa</a></b></li>
                    </ul>
                     <b>Xin chân thành cảm ơn !!!</b>"
                ]
            ];
            Mail::to($mailData['to'])
                ->cc(isset($mailData['cc']) ? $mailData['cc'] : '')
                ->bcc(isset($mailData['bcc']) ? $mailData['bcc'] : '')
                ->send(new SendMail($mailData));
            return 1;
        } catch (Exception $ex) {
            return 0;
        }
    }
    public function setValueStatus(Request $request)
    {
        try {
            $apointment = Apointment::find($request->id);
            if (!$apointment) {
                return redirect()->back()->with('failed', "Don't exsist this apointment !");
            }
            $apointment->status = $request->status;
            $apointment->save();
            return redirect()->back()->with('success', "Update apointment successfull !");
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', 'Error !');
        }
    }
}
