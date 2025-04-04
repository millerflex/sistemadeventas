<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Compra;
use App\Models\Cliente;
use App\Models\Arqueo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    
    public function index(){
        /*Si el usuario está autenticado que me muestre el id de la empresa
        por lo contrario si no lo está que me redireccione al login.
        El atributo check() sirve para verificar si el usuario está autenticado en el sistema.*/
        $empresa_id = Auth::check() ? Auth::user()->empresa_id : redirect()->route('login')->send();

        $total_usuarios = User::where('empresa_id', $empresa_id)->count();
        $total_roles = Role::where('empresa_id', $empresa_id)->count();
        $total_categoria = Categoria::where('empresa_id', $empresa_id)->count();
        $total_productos = Producto::where('empresa_id', $empresa_id)->count();
        $total_proveedores = Proveedor::where('empresa_id', $empresa_id)->count();
        $total_compras = Compra::where('empresa_id', $empresa_id)->count();
        $total_clientes = Cliente::where('empresa_id', $empresa_id)->count();
        $total_arqueos = Arqueo::where('empresa_id', $empresa_id)->count();

        $empresa = Empresa::where('id', $empresa_id)->first();
        return view('admin.index', compact('empresa',
        'total_roles',
        'total_usuarios',
        'total_categoria',
        'total_productos',
        'total_proveedores',
        'total_compras',
        'total_clientes',
        'total_arqueos'));
    }
}
