<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductoController;
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
    return redirect()->route('loginForm');
});

Route::get('/inicio-sesion', [AuthController::class, 'loginForm'])->middleware('guest')->name('loginForm');
Route::post('/autenticar', [AuthController::class, 'login'])->name('login');
Route::post('/cerrar-sesion', [AuthController::class, 'logout'])->name('logout');

Route::get('/registro', [AuthController::class, 'registerForm'])->middleware('guest')->name('registerForm');
Route::post('/registrar', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::resource('productos', ProductoController::class);
});