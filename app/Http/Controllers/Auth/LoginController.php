<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.index')
                : redirect()->route('home');
        }
        return view('auth.login');
    }


    public function login(Request $request)
    {
        // ===============1==============
        // Validate the login form input for email and password.
        $credentials = $request->validate([
            'email'=>['required', 'email'],
            'password'=>['required'],

        ]);
        // dd ($credentials);
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $defaultRedirect = Auth::user()->role === 'admin'
                ? route('admin.index')
                : route('home');

            return redirect()->intended($defaultRedirect)->with('success', $remember 
                ? 'You have successfully logged in with Remember Me activated!' 
                : 'You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Email or password was wrong!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have successfully logged out!');
    }
}