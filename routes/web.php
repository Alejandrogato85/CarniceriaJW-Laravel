<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::view('/', 'inicio')->name('inicio');

Route::view('/nosotros', 'nosotros')->name('nosotros');

Route::view('/cortes', 'cortes')->name('cortes');

Route::view('/contacto', 'contacto')->name('contacto');
