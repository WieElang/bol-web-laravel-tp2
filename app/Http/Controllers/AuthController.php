<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    // Login
    function loginView() {
        return view('auth.login', [
            "title" => "Login"
        ]);
    }

    function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => ['required', Password::min(10)->mixedCase()->numbers()->symbols()]
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors(['loginError', 'Login Failed!, Please Input Correct Email and Password']);
    }


    // Register
    function registerView() {
        return view('auth.register', [
            "title" => "Register"
        ]);
    }

    function registerStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::min(10)->mixedCase()->numbers()->symbols()]
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect('/login')->with('success', 'Registration Success!, Please Login');
    }

    // Reset Password
    function checkValidEmail(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => ['required', Password::min(10)->mixedCase()->numbers()->symbols()]
        ]);
    }

    function resetPasswordView() {
        return view('auth.reset_password', [
            "title" => "Reset Password"
        ]);
    }

    function resetPasswordStore(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => ['required', Password::min(10)->mixedCase()->numbers()->symbols()]
        ]);

        $password = Hash::make($validatedData['password']);
        $user = User::where('email', $validatedData['email']);
        if ($user->first() != null) {
            $user = $user->first();
            
            $user->password = $password;
            $user->save();

            return redirect('/login')->with('success', 'Reset Password Success!, Please Login');
        }
        return back()->withErrors(['email' => 'User Not Found!']);
    }
}
