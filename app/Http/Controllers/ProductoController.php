<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    /* Mostrar productos */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $productos = Producto::with([
            'categoria',
            'user',
        ])
            ->when(
                $buscar,
                function ($query, $buscar) {

                    $query->where(
                        function ($query) use ($buscar) {

                            /* Buscar por nombre del producto */
                            $query->where(
                                'nombre',
                                'like',
                                "%{$buscar}%"
                            )

                            /* Buscar por categoria */
                                ->orWhereHas(
                                    'categoria',
                                    function ($query) use ($buscar) {

                                        $query->where(
                                            'nombre',
                                            'like',
                                            "%{$buscar}%"
                                        );
                                    }
                                );
                        }
                    );
                }
            )
            ->orderBy('nombre')
            ->get();


        /* Categorias para el formulario */
        $categorias = Categoria::orderBy('nombre')
            ->get();


        return view(
            'productos.index',
            compact(
                'productos',
                'categorias',
                'buscar'
            )
        );
    }


    /* Guardar producto */
    public function store(Request $request)
    {
        $datos = $request->validate(
            [
                'categoria_id' => [
                    'required',
                    'exists:categorias,id',
                ],

                'nombre' => [
                    'required',
                    'max:255',
                    Rule::unique(
                        'productos',
                        'nombre'
                    )
                        ->where(
                            'categoria_id',
                            $request->categoria_id
                        ),
                ],

                'unidad_medida' => [
                    'required',
                    Rule::in([
                        'kg',
                        'unidad',
                    ]),
                ],

                'precio_actual' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                /*
                 * Stock del producto.
                 *
                 * Debe ser un número entero
                 * y no puede ser negativo.
                 */
                'stock' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'descripcion' => [
                    'nullable',
                    'max:255',
                ],
            ],
            [
                'categoria_id.required' =>
                    'Selecciona una categoría.',

                'categoria_id.exists' =>
                    'La categoría seleccionada no existe.',


                'nombre.required' =>
                    'Escribí el nombre del producto.',

                'nombre.max' =>
                    'El nombre del producto es demasiado largo.',

                'nombre.unique' =>
                    'Ya existe ese producto en esta categoría.',


                'unidad_medida.required' =>
                    'Selecciona la unidad de medida.',

                'unidad_medida.in' =>
                    'La unidad de medida seleccionada no es válida.',


                'precio_actual.required' =>
                    'Escribí el precio actual.',

                'precio_actual.numeric' =>
                    'El precio debe ser un número.',

                'precio_actual.min' =>
                    'El precio no puede ser negativo.',


                /*
                 * Mensajes de validación
                 * escritos en castellano.
                 */
                'stock.required' =>
                    'Escribí el stock disponible.',

                'stock.integer' =>
                    'El stock debe ser un número entero.',

                'stock.min' =>
                    'El stock no puede ser negativo.',


                'descripcion.max' =>
                    'La descripción es demasiado larga.',
            ]
        );


        /* Usuario que registra el producto */
        $datos['user_id'] = Auth::id();


        /* Estado inicial del producto */
        $datos['estado'] = true;


        /* Guardar producto */
        Producto::create($datos);


        return redirect()
            ->route('productos.index')
            ->with(
                'exito',
                'Producto registrado correctamente.'
            );
    }


    /* Cargar producto para editar */
    public function edit(
        Request $request,
        Producto $producto
    ) {
        $buscar = $request->input('buscar');


        $productos = Producto::with([
            'categoria',
            'user',
        ])
            ->orderBy('nombre')
            ->get();


        /* Categorias para el formulario */
        $categorias = Categoria::orderBy('nombre')
            ->get();


        /* Producto seleccionado */
        $productoEditar = $producto;


        return view(
            'productos.index',
            compact(
                'productos',
                'categorias',
                'buscar',
                'productoEditar'
            )
        );
    }


    /* Actualizar producto */
    public function update(
        Request $request,
        Producto $producto
    ) {
        $datos = $request->validate(
            [
                'categoria_id' => [
                    'required',
                    'exists:categorias,id',
                ],

                'nombre' => [
                    'required',
                    'max:255',
                    Rule::unique(
                        'productos',
                        'nombre'
                    )
                        ->where(
                            'categoria_id',
                            $request->categoria_id
                        )
                        ->ignore(
                            $producto->id
                        ),
                ],

                'unidad_medida' => [
                    'required',
                    Rule::in([
                        'kg',
                        'unidad',
                    ]),
                ],

                'precio_actual' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                /*
                 * Validar stock también
                 * al editar el producto.
                 */
                'stock' => [
                    'required',
                    'integer',
                    'min:0',
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
                'categoria_id.required' =>
                    'Selecciona una categoría.',

                'categoria_id.exists' =>
                    'La categoría seleccionada no existe.',


                'nombre.required' =>
                    'Escribí el nombre del producto.',

                'nombre.max' =>
                    'El nombre del producto es demasiado largo.',

                'nombre.unique' =>
                    'Ya existe ese producto en esta categoría.',


                'unidad_medida.required' =>
                    'Selecciona la unidad de medida.',

                'unidad_medida.in' =>
                    'La unidad de medida seleccionada no es válida.',


                'precio_actual.required' =>
                    'Escribí el precio actual.',

                'precio_actual.numeric' =>
                    'El precio debe ser un número.',

                'precio_actual.min' =>
                    'El precio no puede ser negativo.',


                'stock.required' =>
                    'Escribí el stock disponible.',

                'stock.integer' =>
                    'El stock debe ser un número entero.',

                'stock.min' =>
                    'El stock no puede ser negativo.',


                'descripcion.max' =>
                    'La descripción es demasiado larga.',


                'estado.required' =>
                    'Selecciona el estado del producto.',

                'estado.boolean' =>
                    'El estado seleccionado no es válido.',
            ]
        );


        /* Actualizar producto */
        $producto->update($datos);


        return redirect()
            ->route('productos.index')
            ->with(
                'exito',
                'Producto actualizado correctamente.'
            );
    }


    /* Eliminar producto */
    public function destroy(Producto $producto)
    {
        $producto->delete();


        return redirect()
            ->route('productos.index')
            ->with(
                'exito',
                'Producto eliminado correctamente.'
            );
    }
}