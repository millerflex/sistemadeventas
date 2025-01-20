@extends('adminlte::page')

@section('content_header')
    <h1><b>Datos del cliente</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Datos registrados</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <p>{{ $cliente->nombre_cliente }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p>{{ $cliente->codigo }}</p>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <p>{{ $cliente->telefono }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p>{{ $cliente->email }}</p>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">Volver</a>
                                    </div>
                                </div>
                            </div>
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