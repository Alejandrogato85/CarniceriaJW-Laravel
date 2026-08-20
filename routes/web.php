<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Sitio Publico
|--------------------------------------------------------------------------
*/


Route::view('/', 'inicio')
    ->name('inicio');


Route::view('/nosotros', 'nosotros')
    ->name('nosotros');


Route::view('/cortes', 'cortes')
    ->name('cortes');


Route::view('/contacto', 'contacto')
    ->name('contacto');



/*
|--------------------------------------------------------------------------
| Invitados
|--------------------------------------------------------------------------
*/


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



/*
|--------------------------------------------------------------------------
| Panel de Administracion
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Clientes
    |--------------------------------------------------------------------------
    */

    // Listar clientes
    Route::get(
        '/clientes',
        [ClienteController::class, 'index']
    )
        ->name('clientes.index');


    // Mostrar formulario
    Route::get(
        '/clientes/nuevo',
        [ClienteController::class, 'create']
    )
        ->name('clientes.create');


    // Guardar cliente
    Route::post(
        '/clientes',
        [ClienteController::class, 'store']
    )
        ->name('clientes.store');


    /*
    |--------------------------------------------------------------------------
    | Cerrar Sesion
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/logout',
        [AuthController::class, 'cerrarSesion']
    )
        ->name('logout');

});
