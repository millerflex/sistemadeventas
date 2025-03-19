<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        return view('admin.proveedores.index', compact('proveedores', 'empresa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'empresa'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'nombre'=>'required',
            'celular'=>'required',
        ]);

        $proveedor = new Proveedor();

        $proveedor->empresa = $request->empresa;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->nombre = $request->nombre;
        $proveedor->celular = $request->celular;
        $proveedor->empresa_id = Auth::user()->empresa_id;
        
        $proveedor->save();

        return redirect()->route('admin.proveedores.index')
        ->with('mensaje', 'Se registró el proveedor de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedores.edit', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'empresa'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'nombre'=>'required',
            'celular'=>'required',
        ]);

        $proveedor = Proveedor::find($id);

        $proveedor->empresa = $request->empresa;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->nombre = $request->nombre;
        $proveedor->celular = $request->celular;
        $proveedor->empresa_id = Auth::user()->empresa_id;
        
        $proveedor->save();

        return redirect()->route('admin.proveedores.index')
        ->with('mensaje', 'Se actualizó el proveedor de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Proveedor::destroy($id);
        return redirect()->route('admin.proveedores.index')
        ->with('mensaje', 'Se eliminó el proveedor de manera correcta')
        ->with('icono', 'success');
    }

    public function reporte(){

        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();

        $proveedores = Proveedor::all();

        $pdf = PDF::loadView('admin.proveedores.reporte', compact('empresa', 'proveedores'))
                    ->setPaper('letter', 'LandScape');
        return $pdf->stream();
    }
}
