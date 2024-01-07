<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Driver;
use App\Models\Passenger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $passenger = new Passenger();

        DB::transaction(function () use ($user, $passenger) {
            $user->save();
            $passenger->id = $user->id;
            $passenger->save();
        });
        return redirect()
            ->route('login')
            ->with('swal-title', '¡Éxito!')
            ->with('swal-msg', 'Tu cuenta ha sido creada')
            ->with('swal-icon', 'success');
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
            'description' => 'string|max:255|nullable',
            'phone' => 'string|digits:9|numeric|nullable',
        ]);

        $user = User::find(Auth::id());
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
        $user->description = $request->input('description');
        $user->phone = $request->input('phone');
        if ($request->has('passenger')) {
            $user->role = UserRole::Passenger;
        } else {
            $user->role = UserRole::Driver;
        }
        $passenger = Passenger::find(Auth::id());
        $driver = Driver::find(Auth::id());

        DB::transaction(function () use ($user, $passenger, $driver) {
            $user->save();
            if ($user->role->isPassenger() && !$passenger) {
                $passenger = new Passenger();
                $passenger->id = Auth::id();
                $passenger->save();
            } else if ($user->role->isDriver() && !$driver) {
                $driver = new Driver();
                $driver->id = Auth::id();
                $driver->save();
            }
        });

        return redirect()
            ->route('profile')
            ->with('swal-title', '¡Éxito!')
            ->with('swal-msg', 'Tu perfil ha sido actualizado')
            ->with('swal-icon', 'success');
    }

    public function deleteAccount()
    {
        $user = User::find(Auth::id());
        $passenger = Passenger::find(Auth::id());
        $driver = Driver::find(Auth::id());
        DB::transaction(function () use ($user, $passenger, $driver) {
            $user->delete();
            if ($passenger) {
                $passenger->delete();
            }
            if ($driver) {
                $driver->delete();
            }
        });
        return redirect()->route('home');
    }
}
