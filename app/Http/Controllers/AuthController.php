<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
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
}
