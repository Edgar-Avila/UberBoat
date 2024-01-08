<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('guest.home');
})->name('home');

Route::get('/registro', [AuthController::class, 'registerForm'])->name('register');
Route::get('/iniciar-sesion',[AuthController::class, 'loginForm'])->name('login');

Route::post('/registro', [AuthController::class, 'register']);
Route::post('/iniciar-sesion',[AuthController::class, 'login']);
Route::post('/tema', [ThemeController::class, 'toggleTheme'])->name('theme');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/cerrar-sesion',[AuthController::class, 'logout'])->name('logout');
    Route::get('/mapa', [MapController::class, 'index'])->name('map');
    Route::get('/perfil', [AuthController::class, 'profile'])->name('profile');
    Route::put('/perfil/editar', [AuthController::class, 'editProfile'])->name('editProfile');
    Route::delete('/perfil/eliminar', [AuthController::class, 'deleteAccount'])->name('deleteAccount');
});
