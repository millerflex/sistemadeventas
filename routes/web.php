<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Ruta para ir a la vista principal
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//Rutas para usuario - empresa
Route::get('/crear_empresa', [App\Http\Controllers\EmpresaController::class, 'create'])->name('admin.empresas.create');
//Ruta para mostrar las provincias al seleccionar un país mediante ajax 
Route::get('/crear_empresa/pais/{id_pais}', [App\Http\Controllers\EmpresaController::class, 'buscar_estado'])->name('admin.empresas.create.buscar_estado');
//Ruta para mostrar las ciudades al seleccionar un estado/provincia mediante ajax 
Route::get('/crear_empresa/estado/{id_estado}', [App\Http\Controllers\EmpresaController::class, 'buscar_ciudad'])->name('admin.empresas.create.buscar_ciudad');
Route::post('/crear_empresa/create', [App\Http\Controllers\EmpresaController::class, 'store'])->name('admin.empresas.store');

//Rutas para configuracion
Route::get('/admin/configuracion', [App\Http\Controllers\EmpresaController::class, 'edit'])->name('admin.configuracion.edit')->middleware('auth');
//Ruta para mostrar las provincias al seleccionar un país mediante ajax 
Route::get('/admin/configuracion/pais/{id_pais}', [App\Http\Controllers\EmpresaController::class, 'buscar_estado'])->name('admin.empresas.create.buscar_estado');
//Ruta para mostrar las ciudades al seleccionar un estado/provincia mediante ajax 
Route::get('/admin/configuracion/estado/{id_estado}', [App\Http\Controllers\EmpresaController::class, 'buscar_ciudad'])->name('admin.empresas.create.buscar_ciudad');
Route::put('/admin/configuracion/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('admin.configuracion.update')->middleware('auth');

//Rutas para Roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');
