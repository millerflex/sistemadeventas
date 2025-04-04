<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);

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

        return redirect()->route('admin.clientes.index')
        ->with('mensaje', 'Se registró al cliente de manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'nombre_cliente'=>'required',
            'codigo'=>'required',
            'telefono'=>'required',
            'email'=>'required',
        ]);

        $cliente = Cliente::find($id);
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->codigo = $request->codigo;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->empresa_id = Auth::user()->empresa_id;

        $cliente->save();

        return redirect()->route('admin.clientes.index')
        ->with('mensaje', 'Se actualizó al cliente de manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect()->route('admin.clientes.index')
        ->with('mensaje', 'Se eliminó el registro de manera correcta')
        ->with('icono', 'success');
    }

    public function reporte(){

        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();

        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();

        $pdf = PDF::loadView('admin.clientes.reporte', compact('empresa', 'clientes'));
        return $pdf->stream();
    }
}
