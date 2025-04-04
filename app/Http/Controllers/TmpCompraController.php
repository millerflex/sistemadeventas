<?php

namespace App\Http\Controllers;

use App\Models\TmpCompra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TmpCompraController extends Controller
{
    public function tmp_compras(Request $request){

        $producto = Producto::where('codigo', $request->codigo)
        ->where('empresa_id', Auth::user()->empresa_id)
        ->first();
        $session_id = session()->getId();

        if($producto){

            $tmp_compra_existe = TmpCompra::where('producto_id', $producto->id)
                                            ->where('session_id', $session_id)
                                            ->first();

            //Si registro una compra pero esta ya existe, que me actualice la cántidad
            if($tmp_compra_existe){

                $tmp_compra_existe->cantidad += $request->cantidad; 
                $tmp_compra_existe->save();

                return response()->json([
                'success'=>true, 'message'=>'El producto fue encontrado'
            ]);

            }else{
                $tmp_compras = new TmpCompra();

                $tmp_compras->cantidad = $request->cantidad;
                $tmp_compras->producto_id = $producto->id;

                //Lo que me va a permitir la session_id es diferenciar a un usuario logueado con la misma cuenta pero en otro equipo o en otro navegador
                //Es decir que si un usuario1 está registrando productos en un navegador/equipo y otro usuario2 entra a la misma cuenta pero desde otro navegador/equipo
                //Al usuario2 no le va a mostrar lo que el usuario1 está ingresando en el sistema
                $tmp_compras->session_id = $session_id; //Esta línea de código va a generar un código de session dependiendo del navegador o equipo diferente al que se ingrese
                $tmp_compras->save();
                return response()->json([
                    'success'=>true, 'message'=>'El producto fue encontrado'
                ]);
            }                                

        }else{
            return response()->json([
                'success'=>false, 'message'=>'Producto no encontrado'
            ]);
        }
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TmpCompra $tmpCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TmpCompra $tmpCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TmpCompra $tmpCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            TmpCompra::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el producto'
            ], 500);
        }  
    }
}
