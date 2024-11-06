<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.empresas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //consulta para traer todos los países de la base de datos
        $paises = DB::table('countries')->get();
        $estados = DB::table('states')->get();
        $ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();
        return view('admin.empresas.create', compact('paises', 'estados', 'ciudades', 'monedas'));
    }

    public function buscar_estado($id_pais){
        try {
            $estados = DB::table('states')->where('country_id', $id_pais)->get();
            return view('admin.empresas.cargar_estados', compact('estados'));
        } catch (\Throwable $th) {
            return response()->json(['mensaje'=>'Error']);
        }
    }

    public function buscar_ciudad($id_estado){
        try {
            $ciudades = DB::table('cities')->where('state_id', $id_estado)->get();
            return view('admin.empresas.cargar_ciudades', compact('ciudades'));
        } catch (\Throwable $th) {
            return response()->json(['mensaje'=>'Error']);
        }
    }
    

    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        //Validación en la parte del back-end
        $request->validate([
            'nombre_empresa'=>'required',
            'tipo_empresa'=>'required',
            'nit'=>'required|unique:empresas',
            'telefono'=>'required',
            'correo'=>'required|unique:empresas',
            'cantidad_impuesto'=>'required',
            'nombre_impuesto'=>'required',
            'direccion'=>'required',
            'logo'=>'required|image|mimes:jpg, jpeg, png'  //con mimes validamos que la imagen tiene que ser png, jpg o jpeg
            
        ]);

        //Creo una nueva instanciación del modelo Empresas
        $empresa = new Empresa();

        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->logo = $request->file('logo')->store('logos', 'public');

        $empresa->save();

        //Código para que al momento de registrar una empresa se registre de forma predeterminada un usuario
        $usuario = new User();
        $usuario->name = "Admin";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request['nit']);
        $usuario->empresa_id = $empresa->id;

        $usuario->save();

        /*Con esta línea de código lo que hago es que al momento de registrar la empresa con el usuario por defecto no vuelva al login sino que automáticamente
        ingrese al panel principal ya logeado*/
        Auth::login($usuario);

        return redirect()->route('admin.index')
        ->with('mensaje', 'Se registró la empresa de forma correcta');
    }

    

    public function show(Empresa $empresa)
    {
        //
    }

    
    public function edit(Empresa $empresa)
    {
        return view('admin.configuraciones.edit');
    }

    
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    
    public function destroy(Empresa $empresa)
    {
        //
    }
}
