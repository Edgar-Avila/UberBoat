<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    public function findNearbyDrivers(Request $request) 
    {
        $valid = $request->validate([
            'lat' => 'numeric|required',
            'lng' => 'numeric|required',
            'searchDistance' => 'numeric',
        ]);
        $user = User::find(Auth::id());
        $searchDistance = $request->input('searchDistance', 5000);
        $isPassenger = $user->role->isPassenger();
        if(!$isPassenger) {
            return response()->json(['message' => 'Debe ser un pasajero para realizar esta acción'], 403);
        }

        // Find the nearest drivers
        $drivers = DB::table('drivers')
            ->selectRaw('ST_X(users.location) as lng, ST_Y(users.location) as lat, users.name, users.email, users.id, users.phone, users.description')
            ->join('users', 'users.id', '=', 'drivers.id')
            ->where('available', true)
            ->whereRaw("ST_Distance_Sphere(users.location, point(?, ?)) < ?", [$valid['lng'], $valid['lat'], $searchDistance])
            ->limit(20)
            ->get();
        return response()->json(compact('drivers'));
    }

    public function updateLocation(Request $request) {
        $valid = $request->validate([
            'lat' => 'numeric|required',
            'lng' => 'numeric|required'
        ]);

        $user = User::find(Auth::id());
        $user->location = DB::raw("point($valid[lng], $valid[lat])");
        $user->save();
        
        return response()->json(['message' => 'Ubicación actualizada']);
    }
}
