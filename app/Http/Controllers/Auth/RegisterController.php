<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nim'=>['required','string', 'max:20'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        // ===============1==============
        // Save the validated user data into the database with hashed password and default role 'mahasiswa'.
        User::create([
            'name'=>$validated['name'],
            'nim'=>$validated['nim'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password']),
            'role'=>'mahasiswa',
        ]);

        return redirect('/login')->with('success', 'Registration successful, please login!');
    }
}
