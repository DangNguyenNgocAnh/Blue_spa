<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\Apointment;
use App\Models\Department;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
            return redirect()->route('user.dashboard');
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
        $validator = Validator::make($request->all(), [
            'hour' => ['required', 'date_format:H', 'after:' . now()->setTimezone('Asia/Ho_Chi_Minh')->format('H')],
            'minute' => ['required'],

        ], [
            'hour.after' => 'The hour must be after the current time',
            'minute.after' => 'The hour must be after the current time'
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
                    'time' => DateTime::createFromFormat('Y-m-d H:i', "$request->date $request->hour:$request->minute"),
                    'status' => 'Confirmed',
                    'message' => $request->message
                ]
            );
            return redirect()->route('user.dashboard')->with('success', 'Make a apointment successfull ! ');
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
            'packages' => $user->packages,
            'apointments' => $user->apointments
        ]);
    }
}
