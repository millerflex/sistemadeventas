<?php

namespace App\Http\Controllers;

use App\Models\detalleCompra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetalleCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $producto = Producto::where('codigo', $request->codigo)
        ->where('empresa_id', Auth::user()->empresa_id)
        ->first();
        $id_compra = $request->id_compra;

        if($producto){

            $detalle_compra_existe = detalleCompra::where('producto_id', $producto->id)
                                            ->where('compra_id', $id_compra)
                                            ->first();

            //Si registro una compra pero esta ya existe, que me actualice la cántidad
            if($detalle_compra_existe){

                $detalle_compra_existe->cantidad += $request->cantidad; 
                $detalle_compra_existe->save();

                $producto->stock += $request->cantidad;
                $producto->save();

                return response()->json([
                'success'=>true, 'message'=>'El producto fue encontrado'
            ]);

            }else{
                $detalle_compras = new detalleCompra();

                $detalle_compras->cantidad = $request->cantidad;
                $detalle_compras->producto_id = $producto->id;

                $detalle_compras->compra_id = $id_compra;
                $detalle_compras->save();

                $producto->stock -= $request->cantidad;
                $producto->save();
                
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

    /**
     * Display the specified resource.
     */
    public function show(detalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // try {
        //     detalleCompra::destroy($id);
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Producto eliminado correctamente'
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Error al eliminar el producto'
        //     ], 500);
        // }

        $detalleCompra = detalleCompra::find($id);
        $producto = Producto::find($detalleCompra->producto_id);

        $producto->stock += $detalleCompra->cantidad;
        $producto->save();
        
        detalleCompra::destroy($id);

        return response()->json(['success'=>true]);
    }
}
