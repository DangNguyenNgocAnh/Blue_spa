<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\SendMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('user.view.login');
    }
    public function login(AuthRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password'], $request->filled('rememberMe')))) {
            $request->session()->regenerate();
            if (Gate::allows('notCustomer')) {
                return redirect()->route('admin.dashboard')->with('success', 'Login successfull !');
            }
            return redirect()->route('user.dashboard')->with('success', "Welcome " . Auth::user()->fullname . " !");
        }
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.dashboard');
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
}
