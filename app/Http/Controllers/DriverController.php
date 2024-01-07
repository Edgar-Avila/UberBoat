<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function changeAvailability(Request $request)
    {
        $user = Auth::user();
        if($user->role->isPassenger()) {
            return response()->json(['message' => 'Debe ser un conductor para realizar esta acción'], 403);
        }
        $driver = Driver::find($user->id);
        $driver->available = !$driver->available;
        $driver->save();
        return response()->json(['message' => 'Disponibilidad actualizada']);
    }
}
