<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Empresa;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\TmpVenta;
use App\Models\Arqueo;
use App\Models\MovimientoCaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Nnjeim\World\Models\Currency;
use NumberToWords\NumberToWords;
use NumberFormatter;

class VentaController extends Controller
{


    public function index()
    {
        $arqueoAbierto = Arqueo::whereNull('fecha_cierre')->first();
        $ventas = Venta::with('detallesVenta', 'cliente')->get();
        return view('admin.ventas.index', compact('ventas', 'arqueoAbierto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();

        $session_id = session()->getId(); //Creo una variable de session_id porque como es del mismo equipo lo va a almacenar
        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get(); //Consulto la session

        return view('admin.ventas.create', compact('productos', 'clientes', 'tmp_ventas'));
    }

    public function store_cliente(Request $request){
        
        $request->validate([
            'nombre_cliente'=>'required',
            'codigo'=>'required',
            'telefono'=>'required',
            'email'=>'required',
        ]);

        $cliente = new Cliente();
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->codigo = $request->codigo;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->empresa_id = Auth::user()->empresa_id;

        $cliente->save();

        return response()->json(['success'=>'Cliente registrado']);
    }


    public function store(Request $request)
    {
        $request->validate([
            'fecha_venta'=>'required',
            'precio_total'=>'required'
        ]);

        $session_id = session()->getId();

        $venta = new Venta();
        $venta->fecha_venta = $request->fecha_venta;
        $venta->precio_total = $request->precio_total;
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->cliente_id = $request->cliente_id;

        $venta->save();

        /*Registrar en el arqueo*/
        $arqueo_id = Arqueo::whereNull('fecha_cierre')->first();
        $movimiento = new MovimientoCaja();
        
        $movimiento->tipo = "INGRESO";
        $movimiento->monto = $request->precio_total;
        $movimiento->descripcion = "Venta de productos";
        $movimiento->arqueo_id = $arqueo_id->id;

        $movimiento->save();
        /*Registrar en el arqueo*/

        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();

        foreach($tmp_ventas as $tmp_venta){

            $producto = Producto::where('id', $tmp_venta->producto->id)->first();

            $detalle_venta = new DetalleVenta();
            $detalle_venta->cantidad = $tmp_venta->cantidad;
            $detalle_venta->venta_id = $venta->id;
            $detalle_venta->producto_id = $tmp_venta->producto_id;

            $detalle_venta->save();

            $producto->stock -= $tmp_venta->cantidad;
            $producto->save();
        }

        //Una vez registrados los detalles de la venta, eliminamos los registros de la tabla temporal de ventas
        TmpVenta::where('session_id', $session_id)->delete();

        return redirect()->route('admin.ventas.index')
        ->with('mensaje', 'Venta registrada correctamente')
        ->with('icono', 'success');
    }

    public function pdf($id){

        //Función para pasar de letras a decimales
        function numeroALetrasConDecimales($numero){
            $formatter = new NumberFormatter("es", NumberFormatter::SPELLOUT);
            
            //Divir el número en parte entera y decimal
            $partes = explode('.', number_format($numero, 2, '.', '' ));

            $entero = $formatter->format($partes[0]);
            $decimal = $formatter->format($partes[1]);

            return ucfirst("$entero con $decimal/100");
        }

        $id_empresa = Auth::user()->empresa_id;
        $empresa = Empresa::where('id', $id_empresa)->first();
        $moneda = Currency::find($empresa->moneda);
        $moneda->symbol;
        $venta = Venta::with('detallesVenta', 'cliente')->findOrFail($id);

        //Muestro el valor del precio en letras
        $numero = $venta->precio_total;
        $literal = numeroALetrasConDecimales($numero);
        
        $pdf = PDF::loadView('admin.ventas.pdf', compact('empresa', 'venta', 'moneda', 'literal'));
        return $pdf->stream();
        //return view('admin.ventas.pdf');
    }

    public function show($id)
    {
        $venta = Venta::with('detallesVenta', 'cliente')->findOrFail($id);
        return view('admin.ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productos = Producto::all();
        $clientes = Cliente::all();
        $venta = Venta::with('detallesVenta', 'cliente')->findOrFail($id);
        return view('admin.ventas.edit', compact('venta', 'productos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = $request->all();
        // return response()->json($datos);

        $request->validate([
            'fecha_venta'=>'required',
            'precio_total'=>'required',
        ]);

        $venta = Venta::find($id);
        $venta->fecha_venta = $request->fecha_venta;
        $venta->precio_total = $request->precio_total;
        $venta->cliente_id = $request->cliente_id;
        $venta->empresa_id = Auth::user()->empresa_id;

        $venta->save();

        return redirect()->route('admin.ventas.index')
        ->with('mensaje', 'Venta actualizada correctamente')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venta = Venta::find($id);

        foreach($venta->detallesVenta as $detalle){
            $producto = Producto::find($detalle->producto_id);
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }

        $venta->detallesVenta()->delete();
        Venta::destroy($id);

        return redirect()->route('admin.ventas.index')
        ->with('mensaje', 'Venta eliminada correctamente')
        ->with('icono', 'success');
    }

    public function reporte(){

        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();

        $ventas = Venta::with('Cliente')->get();

        $pdf = PDF::loadView('admin.ventas.reporte', compact('empresa', 'ventas'));
        return $pdf->stream();
    }
}
