<?php

namespace App\Http\Controllers;

use App\Models\TmpVenta;
use App\Models\Producto;
use Illuminate\Http\Request;

class TmpVentaController extends Controller
{

    public function tmp_ventas(Request $request){

        $producto = Producto::where('codigo', $request->codigo)->first();
        $session_id = session()->getId();

        if($producto){

            $tmp_venta_existe = TmpVenta::where('producto_id', $producto->id)
                                            ->where('session_id', $session_id)
                                            ->first();

            //Si registro una compra pero esta ya existe, que me actualice la cántidad
            if($tmp_venta_existe){

                $tmp_venta_existe->cantidad += $request->cantidad; 
                $tmp_venta_existe->save();

                return response()->json([
                'success'=>true, 'message'=>'El producto fue encontrado'
            ]);

            }else{
                $tmp_ventas = new TmpVenta();

                $tmp_ventas->cantidad = $request->cantidad;
                $tmp_ventas->producto_id = $producto->id;

                //Lo que me va a permitir la session_id es diferenciar a un usuario logueado con la misma cuenta pero en otro equipo o en otro navegador
                //Es decir que si un usuario1 está registrando productos en un navegador/equipo y otro usuario2 entra a la misma cuenta pero desde otro navegador/equipo
                //Al usuario2 no le va a mostrar lo que el usuario1 está ingresando en el sistema
                $tmp_ventas->session_id = $session_id; //Esta línea de código va a generar un código de session dependiendo del navegador o equipo diferente al que se ingrese
                $tmp_ventas->save();
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
    public function show(TmpVenta $tmpVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TmpVenta $tmpVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TmpVenta $tmpVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        TmpVenta::destroy($id);
        return response()->json(['success'=>true]);
    }
}
