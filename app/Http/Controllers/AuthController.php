<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm() {
        return view('guest.register');
    }

    public function register(Request $request) {
        $valid = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|max:255|min:8',
            'confirm' => 'required|string|max:255|min:8|same:password'
        ]);

        $user = new User();
        $user->name = $valid['name'];
        $user->email = $valid['email'];
        $user->password = Hash::make($valid['password']);
        $user->save();
        return redirect()->route('login');
    }

    public function loginForm() {
        return view('guest.login');
    }

    public function login(Request $request) {
        $valid = $request->validate([
            'email' => 'required|email|string|max:255|exists:users,email',
            'password' => 'required|string|max:255|min:8',
        ]);

        $attempt = Auth::attempt($valid);

        if ($attempt) {
            return redirect()->route('map');
        } else {
            return redirect()->route('login');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
