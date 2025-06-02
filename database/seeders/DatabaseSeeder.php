<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Empresa;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    Empresa::create([
    'nombre_empresa' => 'Empresa Principal',
    'tipo_empresa' => 'S.A.',  // o lo que corresponda
    'nit' => '123456789',
    'telefono' => '555-1234',
    'correo' => 'contacto@empresa.com',
    'cantidad_impuesto' => 12,
    'nombre_impuesto' => 'IVA',
    'moneda' => 'USD',
    'direccion' => 'Dirección de la empresa',
    'ciudad' => 'Ciudad Ejemplo',
    'departamento' => 'Departamento Ejemplo',
    'codigo_postal' => '00000',
    'logo' => "WAOS",  // o ruta/URL al logo
    'pais' => 'PERU'
]);

    // Crear el rol ADMINISTRADOR con empresa_id = 1
    $administrador = Role::firstOrCreate(
        ['name' => 'ADMINISTRADOR', 'guard_name' => 'web'],
        ['empresa_id' => 1]
    );
      $permisos = [
            'roles - index',
            'roles - create',
            'roles - show',
            'roles - edit',
            'roles - delete',

            'permiso - index',
            'permiso - create',
            'permiso - show',
            'permiso - edit',
            'permiso - delete',

            'usuarios - index',
            'usuarios - reportes',
            'usuarios - create',
            'usuarios - show',
            'usuarios - edit',
            'usuarios - delete',

            'categorias - index',
            'categorias - reportes',
            'categorias - create',
            'categorias - show',
            'categorias - edit',
            'categorias - delete',

            'productos - index',
            'productos - reportes',
            'productos - create',
            'productos - show',
            'productos - edit',
            'productos - delete',

            'proveedores - index',
            'proveedores - reportes',
            'proveedores - create',
            'proveedores - show',
            'proveedores - edit',
            'proveedores - delete',

            'compras - index',
            'compras - reportes',
            'compras - create',
            'compras - show',
            'compras - edit',
            'compras - delete',

            'clientes - index',
            'clientes - reportes',
            'clientes - create',
            'clientes - show',
            'clientes - edit',
            'clientes - delete',

            'ventas - index',
            'ventas - reportes',
            'ventas - create',
            'ventas - show',
            'ventas - edit',
            'ventas - delete',
            'ventas - impresion - factura',

            'arqueos - index',
            'arqueos - reportes',
            'arqueos - create',
            'arqueos - show',
            'arqueos - edit',
            'arqueos - ingresos - egresos',
            'arqueos - delete',
            'arqueos - cierre - caja',
        ];
        // Crear o actualizar permisos y asignarlos al rol ADMINISTRADOR
        foreach ($permisos as $permisoNombre) {
            $permiso = Permission::firstOrCreate(['name' => $permisoNombre]);
            $administrador->givePermissionTo($permiso);
        }


    $user = User::create([
        'name' => 'admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'empresa_id' => 1,
    ]);

    $user->assignRole('ADMINISTRADOR');

       User::factory()->count(10)->create(['empresa_id' => 1]);
    
    // Crear categorías manualmente
 Categoria::create([
    'nombre' => 'Electrónica',
    'descripcion' => 'Categoría de productos electrónicos',
    'empresa_id' => 1,
]);

Categoria::create([
    'nombre' => 'Ropa',
    'descripcion' => 'Categoría de ropa y accesorios',
    'empresa_id' => 1,
]);

Categoria::create([
    'nombre' => 'Alimentos',
    'descripcion' => 'Categoría de alimentos y bebidas',
    'empresa_id' => 1,
]);

Categoria::create([
    'nombre' => 'Hogar',
    'descripcion' => 'Categoría de productos para el hogar',
    'empresa_id' => 1,
]);

Categoria::create([
    'nombre' => 'Deportes',
    'descripcion' => 'Categoría de artículos deportivos',
    'empresa_id' => 1,
]);


    // Crear 100 productos con factory
    Producto::factory()->count(10)->create();
}

}
