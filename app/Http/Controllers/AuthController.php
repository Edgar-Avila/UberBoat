<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('guest.register');
    }

    public function register(Request $request)
    {
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

    public function loginForm()
    {
        return view('guest.login');
    }

    public function login(Request $request)
    {
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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function editProfile(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = User::find(Auth::id());
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
        if ($request->has('passenger')) {
            $user->role = UserRole::Passenger;
        } else {
            $user->role = UserRole::Driver;
        }

        $user->save();
        

        return redirect()
            ->route('profile')
            ->with('swal-title', '¡Éxito!')
            ->with('swal-msg', 'Tu perfil ha sido actualizado')
            ->with('swal-icon', 'success');
    }
}
