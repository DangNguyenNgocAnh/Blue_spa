<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return redirect()->route('welcome');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
    public function show(User $user)
    {
    }
    public function createApointment(User $user)
    {
    }
    public function showAllPackage(User $user)
    {
    }
    public function changePassword(User $user)
    {
    }
}
