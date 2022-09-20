<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (auth('admin')->attempt($credentials)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.loginForm')
                ->withErrors('These credentials do not match our records.');
        }
    }

    public function logout()
    {
        Session::flush();
        auth('admin')->logout();
        return redirect()->route('admin.loginForm');
    }
}
