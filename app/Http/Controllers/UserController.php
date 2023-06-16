<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
    public function createApointment(User $user)
    {
    }
    public function showAllPackage(User $user)
    {
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        if (Hash::check($request->currentPass, ->password)) {
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
}
