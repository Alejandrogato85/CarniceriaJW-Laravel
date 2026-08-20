<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;




Route::view('/', 'inicio')->name('inicio');



Route::view('/nosotros', 'nosotros')
    ->name('nosotros');

Route::view('/cortes', 'cortes')
    ->name('cortes');

Route::view('/contacto', 'contacto')
    ->name('contacto');




Route::middleware('guest')->group(function () {

    // Mostrar formulario de login
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    // Procesar login
    Route::post('/login', [AuthController::class, 'iniciarSesion'])
        ->name('login.store');

    // Mostrar formulario de registro
    Route::get('/register', [AuthController::class, 'register'])
        ->name('register');

    // Procesar registro
    Route::post('/register', [AuthController::class, 'registrarUsuario'])
        ->name('register.store');

});




Route::middleware('auth')->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');

    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'cerrarSesion'])
        ->name('logout');

});
