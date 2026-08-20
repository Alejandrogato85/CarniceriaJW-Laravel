<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    /* Mostrar categorias */

    public function index(Request $request)
    {
        $buscar = $request->input('buscar');


        $categorias = Categoria::when(
            $buscar,
            function ($query, $buscar) {

                $query->where(
                    'nombre',
                    'like',
                    "%{$buscar}%"
                );

            }
        )
            ->orderBy('nombre')
            ->get();


        return view(
            'categorias.index',
            compact(
                'categorias',
                'buscar'
            )
        );
    }


    /* Guardar categoria */

    public function store(Request $request)
    {
        $datos = $request->validate(
            [
                'nombre' => [
                    'required',
                    'max:255',
                    'unique:categorias,nombre',
                ],

                'descripcion' => [
                    'nullable',
                    'max:255',
                ],
            ],
            [
                'nombre.required' =>
                    'Escribí el nombre de la categoría.',

                'nombre.max' =>
                    'El nombre de la categoría es demasiado largo.',

                'nombre.unique' =>
                    'Ya existe una categoría con ese nombre.',

                'descripcion.max' =>
                    'La descripción es demasiado larga.',
            ]
        );


        /* Estado inicial */

        $datos['estado'] = true;


        /* Guardar categoria */

        Categoria::create($datos);


        return redirect()
            ->route('categorias.index')
            ->with(
                'exito',
                'Categoría registrada correctamente.'
            );
    }


    /* Cargar categoria para editar */

    public function edit(
        Request $request,
        Categoria $categoria
    ) {
        $buscar = $request->input('buscar');


        $categorias = Categoria::orderBy('nombre')
            ->get();


        $categoriaEditar = $categoria;


        return view(
            'categorias.index',
            compact(
                'categorias',
                'buscar',
                'categoriaEditar'
            )
        );
    }


    /* Actualizar categoria */

    public function update(
        Request $request,
        Categoria $categoria
    ) {
        $datos = $request->validate(
            [
                'nombre' => [
                    'required',
                    'max:255',

                    Rule::unique(
                        'categorias',
                        'nombre'
                    )->ignore($categoria->id),
                ],

                'descripcion' => [
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
                    'Escribí el nombre de la categoría.',

                'nombre.max' =>
                    'El nombre de la categoría es demasiado largo.',

                'nombre.unique' =>
                    'Ya existe otra categoría con ese nombre.',

                'descripcion.max' =>
                    'La descripción es demasiado larga.',

                'estado.required' =>
                    'Selecciona el estado de la categoría.',

                'estado.boolean' =>
                    'El estado seleccionado no es válido.',
            ]
        );


        /* Actualizar categoria */

        $categoria->update($datos);


        return redirect()
            ->route('categorias.index')
            ->with(
                'exito',
                'Categoría actualizada correctamente.'
            );
    }


    /* Eliminar categoria */

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();


        return redirect()
            ->route('categorias.index')
            ->with(
                'exito',
                'Categoría eliminada correctamente.'
            );
    }
}
