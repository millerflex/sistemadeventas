@extends('adminlte::page')

@section('content_header')
    <h1><b>Actualización de un Arqueo</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ingrese los datos</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <form action="{{ url('/admin/arqueos', $arqueo->id) }}" method="post">
                            @csrf
                            @method('PUT') 
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fecha_apertura">Fecha de apertura</label>
                                        <input type="datetime-local" name="fecha_apertura" value="{{ $arqueo->fecha_apertura }}" class="form-control" required>
                                        @error('fecha_apertura')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="monto_inicial">Monto Inicial</label>
                                        <input type="text" name="monto_inicial" value="{{ $arqueo->monto_inicial }}" class="form-control">
                                        @error('monto_inicial')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input type="text" name="descripcion" value="{{ $arqueo->descripcion }}" class="form-control">
                                        @error('descripcion')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ url('/admin/arqueos') }}" class="btn btn-secondary">Volver</a>
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