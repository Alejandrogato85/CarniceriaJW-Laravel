<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /* Mostrar todos los clientes */

    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $clientes = Cliente::with('user')
            ->when($buscar, function ($query, $buscar) {

                $query->where(function ($query) use ($buscar) {

                    $query->where(
                        'nombre',
                        'like',
                        "%{$buscar}%"
                    )
                        ->orWhere(
                            'carnet',
                            'like',
                            "%{$buscar}%"
                        )
                        ->orWhere(
                            'telefono',
                            'like',
                            "%{$buscar}%"
                        );

                });

            })
            ->orderBy('nombre')
            ->get();

        return view(
            'clientes.index',
            compact(
                'clientes',
                'buscar'
            )
        );
    }


    /* Guardar cliente */

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


        /* Usuario que registra al cliente */

        $datos['user_id'] = Auth::id();


        /* Estado inicial del cliente */

        $datos['estado'] = true;


        /* Guardar cliente */

        Cliente::create($datos);


        return redirect()
            ->route('clientes.index')
            ->with(
                'exito',
                'Cliente registrado correctamente.'
            );
    }


    /* Mostrar cliente para editar */

    public function edit(
        Request $request,
        Cliente $cliente
    ) {
        $buscar = $request->input('buscar');

        $clientes = Cliente::with('user')
            ->orderBy('nombre')
            ->get();

        $clienteEditar = $cliente;

        return view(
            'clientes.index',
            compact(
                'clientes',
                'buscar',
                'clienteEditar'
            )
        );
    }


    /* Actualizar cliente */

    public function update(
        Request $request,
        Cliente $cliente
    ) {
        $datos = $request->validate(
            [
                'nombre' => [
                    'required',
                    'max:255',
                ],

                'carnet' => [
                    'required',
                    'max:20',

                    Rule::unique(
                        'clientes',
                        'carnet'
                    )->ignore($cliente->id),
                ],

                'telefono' => [
                    'required',
                    'max:20',
                ],

                'direccion' => [
                    'nullable',
                    'max:255',
                ],

                'estado' => [
                    'required',
                    'boolean',
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
                    'Ya existe otro cliente con ese carnet.',


                'telefono.required' =>
                    'Escribí el teléfono del cliente.',

                'telefono.max' =>
                    'El teléfono es demasiado largo.',


                'direccion.max' =>
                    'La dirección es demasiado larga.',


                'estado.required' =>
                    'Selecciona el estado del cliente.',

                'estado.boolean' =>
                    'El estado seleccionado no es válido.',
            ]
        );


        /* Actualizar cliente */

        $cliente->update($datos);


        return redirect()
            ->route('clientes.index')
            ->with(
                'exito',
                'Cliente actualizado correctamente.'
            );
    }


    /* Eliminar cliente */

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();


        return redirect()
            ->route('clientes.index')
            ->with(
                'exito',
                'Cliente eliminado correctamente.'
            );
    }
}
