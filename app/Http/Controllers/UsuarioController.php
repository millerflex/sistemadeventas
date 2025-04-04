<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Con estas consultas voy a mostrar el usuario que está registrado en mi empresa y no en todas las que se encuentran en la base de datos.
        $empresa_id = Auth::user()->empresa_id;
        $usuarios = User::where('empresa_id', $empresa_id)->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required | confirmed',
            ]);

            $usuario = new User();
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->empresa_id = Auth::user()->empresa_id;

            $usuario->save();

            $usuario->assignRole($request->role); //Al usuario registrado se le asigna el rol

            return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se registró el usuario de forma correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'. $id,
            'password'=>'confirmed',
            ]);



            $usuario = User::find($id);

            $usuario->name = $request->name;
            $usuario->email = $request->email;

            //Pregunto si el campo password está lleno que lo actualice, sino no. El método filled sirve para verificar si el campo está vacio o no.
            //Si el campo password está vacio, que no se modifique, de lo contrario si se va a modificar.
            if($request->filled('password')){
                $usuario->password = Hash::make($request->password);
            }

            $usuario->empresa_id = Auth::user()->empresa_id;

            $usuario->save();

            $usuario->syncRoles($request->role); //El método syncRoles() me permite reemplazar el rol que ya tiene el usuario

            return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se modificó el usuario de forma correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);
            return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se eliminó al usuario de forma correcta')
            ->with('icono', 'success');
    }

    public function reporte(){

        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();

        $usuarios = User::where('empresa_id', Auth::user()->empresa_id)->get();

        $pdf = PDF::loadView('admin.usuarios.reporte', compact('empresa', 'usuarios'));
        return $pdf->stream();
    }
}
