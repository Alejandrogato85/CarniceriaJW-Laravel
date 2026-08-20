<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Mostrar todos los clientes.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();

        return view(
            'clientes.index',
            compact('clientes')
        );
    }


    /**
     * Mostrar formulario para registrar cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }


    /**
     * Guardar cliente.
     */
    public function store(Request $request)
    {
        $datos = $request->validate(
            [
                'nombre' => [
                    'required',
                    'max:255',
                ],

                'carnet' => [
                    'required',
                    'max:20',
                    'unique:clientes,carnet',
                ],

                'telefono' => [
                    'required',
                    'max:20',
                ],

                'direccion' => [
                    'nullable',
                    'max:255',
                ],
            ],
            [
                'nombre.required' =>
                    'Escribí el nombre del cliente.',

                'nombre.max' =>
                    'El nombre es demasiado largo.',


                'carnet.required' =>
                    'Escribí el carnet del cliente.',

                'carnet.max' =>
                    'El carnet es demasiado largo.',

                'carnet.unique' =>
                    'Ya existe un cliente con ese carnet.',


                'telefono.required' =>
                    'Escribí el teléfono del cliente.',

                'telefono.max' =>
                    'El teléfono es demasiado largo.',


                'direccion.max' =>
                    'La dirección es demasiado larga.',
            ]
        );


        Cliente::create($datos);


        return redirect()
            ->route('clientes.index')
            ->with(
                'exito',
                'Cliente registrado correctamente.'
            );
    }
}
