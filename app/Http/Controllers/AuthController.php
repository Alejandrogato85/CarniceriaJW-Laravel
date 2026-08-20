<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Mostrar formulario de login
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('pages.auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | Mostrar formulario de registro
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        return view('pages.auth.register');
    }


    /*
    |--------------------------------------------------------------------------
    | Registrar usuario
    |--------------------------------------------------------------------------
    */

    public function registrarUsuario(Request $request)
    {
        $datos = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'telefono' => ['required', 'string', 'max:20'],
                'password' => ['required', 'confirmed', 'min:8'],
            ],
            [
                'name.required' => 'El nombre es obligatorio.',
                'name.max' => 'El nombre no puede tener más de 255 caracteres.',

                'email.required' => 'El correo es obligatorio.',
                'email.email' => 'Escribe un correo válido.',
                'email.unique' => 'Este correo ya está registrado.',

                'telefono.required' => 'El teléfono es obligatorio.',
                'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',

                'password.required' => 'La contraseña es obligatoria.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            ]
        );

        User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'telefono' => $datos['telefono'],
            'password' => Hash::make($datos['password']),
        ]);

        return redirect('/login')
            ->with('success', 'Cuenta creada correctamente. Ya puedes iniciar sesión.');
    }


    /*
    |--------------------------------------------------------------------------
    | Iniciar sesión
    |--------------------------------------------------------------------------
    */

    public function iniciarSesion(Request $request)
    {
        $credenciales = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ],
            [
                'email.required' => 'El correo es obligatorio.',
                'email.email' => 'Escribe un correo válido.',

                'password.required' => 'La contraseña es obligatoria.',
            ]
        );

        $recordar = $request->boolean('remember');

        if (Auth::attempt($credenciales, $recordar)) {

            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'El correo o la contraseña son incorrectos.',
            ])
            ->onlyInput('email');
    }


    public function cerrarSesion(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
}


