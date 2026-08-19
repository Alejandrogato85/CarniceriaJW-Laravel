<?php
use App\Models\Herramienta;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::view('/', 'inicio')->name('inicio');

Route::view('/nosotros', 'nosotros')->name('nosotros');

Route::view('/cortes', 'cortes')->name('cortes');

Route::view('/contacto', 'contacto')->name('contacto');




Route::get('/herramientas', function () {

    $herramientas = Herramienta::all();

    return view('herramientas', [
        'herramientas' => $herramientas,
    ]);
});



Route::get('/herramientas/nuevo', function () {

    return view('herramienta-nuevo');

});



Route::post('/herramientas/nuevo', function () {

    request()->validate(
        [
            'nombre' => 'required',
            'precio' => 'required|integer',
        ],
        [
            'nombre.required' => 'Escribí el nombre de la herramienta. Alejo',
            'precio.required' => 'Escribí el precio de la herramienta. Alejo',
            'precio.integer' => 'El precio se anota solo con cifras. Alejo',
        ]
    );

    Herramienta::create([
        'nombre' => request()->input('nombre'),
        'precio' => request()->input('precio'),
    ]);

    return redirect('/herramientas');

});
