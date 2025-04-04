<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TmpCompra;
use App\Models\detalleCompra;
use App\Models\MovimientoCaja;
use App\Models\Arqueo;
use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arqueoAbierto = Arqueo::whereNull('fecha_cierre')
        ->where('empresa_id', Auth::user()->empresa_id)
        ->first();

        $compras = Compra::with('detalles')
        ->where('empresa_id', Auth::user()->empresa_id)
        ->get();

        return view('admin.compras.index', compact('compras', 'arqueoAbierto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();

        $session_id = session()->getId(); //Creo una variable de session_id porque como es del mismo equipo lo va a almacenar
        $tmp_compras = TmpCompra::where('session_id', $session_id)->get(); //Consulto la session

        return view('admin.compras.create', compact('productos', 'proveedores', 'tmp_compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha_compra'=>'required',
            'comprobante'=>'required',
            'precio_total'=>'required',
        ]);

        $compra = new Compra();
        $compra->fecha_compra = $request->fecha_compra;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->proveedor_id = $request->proveedor_id;

        $compra->save();

        /*Registrar en el arqueo*/
        $arqueo_id = Arqueo::whereNull('fecha_cierre')
        ->where('empresa_id', Auth::user()->empresa_id)
        ->first();
        $movimiento = new MovimientoCaja();
        
        $movimiento->tipo = "EGRESO";
        $movimiento->monto = $request->precio_total;
        $movimiento->descripcion = "Compra de productos";
        $movimiento->arqueo_id = $arqueo_id->id;

        $movimiento->save();
        /*Registrar en el arqueo*/

        $session_id = session()->getId(); //Creo una variable de session_id porque como es del mismo equipo lo va a almacenar
        $tmp_compras = TmpCompra::where('session_id', $session_id)->get();

        foreach($tmp_compras as $tmp_compra){

            $producto = Producto::where('id', $tmp_compra->producto_id)->first();
            $detalle_compra = new detalleCompra();

            $detalle_compra->cantidad = $tmp_compra->cantidad;
            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->producto_id = $tmp_compra->producto_id;

            $detalle_compra->save();

            //Actualizamos el stock cuando hacemos la compra de un producto ya existente en el inventario
            $producto->stock += $tmp_compra->cantidad;
            $producto->save();

        }

        TmpCompra::where('session_id', $session_id)->delete();

        return redirect()->route('admin.compras.index')
        ->with('mensaje', 'Compra registrada correctamente')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);
        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        
        return view('admin.compras.edit', compact('compra','proveedores','productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'fecha_compra'=>'required',
            'comprobante'=>'required',
            'precio_total'=>'required',
        ]);

        $compra = Compra::find($id);
        $compra->fecha_compra = $request->fecha_compra;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->proveedor_id = $request->proveedor_id;

        $compra->save();

        return redirect()->route('admin.compras.index')
        ->with('mensaje', 'Los datos se actualizaron correctamente')
        ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compra = Compra::find($id);

        foreach($compra->detalles as $detalle){
            $producto = Producto::find($detalle->producto_id);
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        $compra->detalles()->delete();
        Compra::destroy($id);

        return redirect()->route('admin.compras.index')
        ->with('mensaje', 'Se eliminó la compra de manera correcta')
        ->with('icono', 'success');
    }

    public function reporte(){

        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();

        $compras = Compra::where('empresa_id', Auth::user()->empresa_id)->get();

        $pdf = PDF::loadView('admin.compras.reporte', compact('empresa', 'compras'));
        return $pdf->stream();
    }
}
