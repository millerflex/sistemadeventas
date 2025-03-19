<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permisos = Permission::all();
        return view('admin.permisos.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permisos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = $request->all();
        // return response()->json($datos);

        $request->validate([
            'name'=>'required|unique:permissions,name'
        ]);

        Permission::create(['name'=>$request->name]);

        return redirect()->route('admin.permisos.index')
        ->with('mensaje', 'Se registró el permiso de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $permiso = Permission::find($id);
        return view('admin.permisos.show', compact('permiso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permiso = Permission::findorFail($id);
        return view('admin.permisos.edit', compact('permiso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = $request->all();
        // return response()->json($datos);

        $request->validate([
            'name'=>'required|unique:permissions,name,'.$id
        ]);

        $permiso = Permission::find($id);
        $permiso->update(['name'=>$request->name]);

        return redirect()->route('admin.permisos.index')
                ->with('mensaje', 'Se actualizó el permiso de la manera correcta')
                ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permiso = Permission::find($id);
        $permiso->delete();

        return redirect()->route('admin.permisos.index')
                ->with('mensaje', 'Se eliminó el permiso de la manera correcta')
                ->with('icono', 'success');
    }
}
