<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
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
    Route::get(
        '/login',
        [AuthController::class, 'login']
    )
        ->name('login');


    // Procesar login
    Route::post(
        '/login',
        [AuthController::class, 'iniciarSesion']
    )
        ->name('login.store');


    // Mostrar formulario de registro
    Route::get(
        '/register',
        [AuthController::class, 'register']
    )
        ->name('register');


    // Procesar registro
    Route::post(
        '/register',
        [AuthController::class, 'registrarUsuario']
    )
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


    // Guardar cliente
    Route::post(
        '/clientes',
        [ClienteController::class, 'store']
    )
        ->name('clientes.store');


    // Editar cliente
    Route::get(
        '/clientes/{cliente}/editar',
        [ClienteController::class, 'edit']
    )
        ->name('clientes.edit');


    // Actualizar cliente
    Route::put(
        '/clientes/{cliente}',
        [ClienteController::class, 'update']
    )
        ->name('clientes.update');


    // Eliminar cliente
    Route::delete(
        '/clientes/{cliente}',
        [ClienteController::class, 'destroy']
    )
        ->name('clientes.destroy');


    /*
    |--------------------------------------------------------------------------
    | Categorias
    |--------------------------------------------------------------------------
    */

    // Listar categorias
    Route::get(
        '/categorias',
        [CategoriaController::class, 'index']
    )
        ->name('categorias.index');


    // Guardar categoria
    Route::post(
        '/categorias',
        [CategoriaController::class, 'store']
    )
        ->name('categorias.store');


    // Editar categoria
    Route::get(
        '/categorias/{categoria}/editar',
        [CategoriaController::class, 'edit']
    )
        ->name('categorias.edit');


    // Actualizar categoria
    Route::put(
        '/categorias/{categoria}',
        [CategoriaController::class, 'update']
    )
        ->name('categorias.update');


    // Eliminar categoria
    Route::delete(
        '/categorias/{categoria}',
        [CategoriaController::class, 'destroy']
    )
        ->name('categorias.destroy');


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
