@extends('adminlte::page')

@section('content_header')
    <h1><b>Actualización del proveedor: {{ $proveedor->empresa }}</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-9">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ingrese los datos</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <form action="{{ url('/admin/proveedores', $proveedor->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="empresa">Empresa</label>
                                                <input type="text" name="empresa" value="{{ $proveedor->empresa }}" class="form-control" required>
                                                @error('empresa')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" name="direccion" value="{{ $proveedor->direccion }}" class="form-control" required>
                                                @error('direccion')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="number" name="telefono" value="{{ $proveedor->telefono }}" class="form-control" required>
                                                @error('telefono')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email"  name="email" value="{{ $proveedor->email }}" class="form-control" required>
                                                @error('email')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre">Nombre del Proveedor</label>
                                                <input type="text" value="{{ $proveedor->nombre}}" name="nombre"class="form-control" required>
                                                @error('nombre')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="celular">Celular del Proveedor</label>
                                                <input type="number" value="{{ $proveedor->celular}}"  name="celular" class="form-control" required>
                                                @error('celular')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        
                                    </div>

                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ url('/admin/proveedores') }}" class="btn btn-secondary">Volver</a>
                                        <button type="submit" class="btn btn-success"><i class="bi bi-arrow-clockwise"></i> Actualizar</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop