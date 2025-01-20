@extends('adminlte::page')

@section('content_header')
    <h1><b>Actualizar los datos del cliente</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ingrese los datos</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <form action="{{ url('/admin/clientes',$cliente->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre del cliente</label>
                                        <input type="text" name="nombre_cliente" value="{{ $cliente->nombre_cliente }}" class="form-control" required>
                                        @error('nombre_cliente')
                                        <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Código del cliente</label>
                                        <input type="text" name="codigo" value="{{ $cliente->codigo }}" class="form-control" required>
                                        @error('codigo')
                                        <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Teléfono</label>
                                        <input type="text" name="telefono" value="{{ $cliente->telefono }}" class="form-control" required>
                                        @error('telefono')
                                        <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Correo</label>
                                        <input type="email" name="email" value="{{ $cliente->email }}" class="form-control" required>
                                        @error('email')
                                        <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="bi bi-arrow-clockwise"></i> Actualizar</button>
                                        <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">Volver</a>
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