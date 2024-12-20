<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'name'=>'required|unique:roles',
        ]);

        //Creo una nueva instanciación del modelo Empresas
        $roles = new Role();

        $roles->name = $request->name;
        $roles->guard_name = "web";
        

        $roles->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se registró el rol de forma correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rol = Role::find($id);
        return view('admin.roles.show', compact('rol'));
    }

    
    public function edit($id)
    {
        $rol = Role::find($id);
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'name'=>'required|unique:roles,name,'.$id,
        ]);

        $roles = Role::find($id);

        $roles->name = $request->name;
        $roles->guard_name = "web";
        

        $roles->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se actualizó el rol de forma correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Role::destroy($id);
        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Se eliminó el rol de forma correcta')
            ->with('icono', 'success');
    }
}
