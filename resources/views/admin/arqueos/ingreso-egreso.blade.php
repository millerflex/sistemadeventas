@extends('adminlte::page')

@section('content_header')
    <h1><b>Registro de Ingreso/Egreso</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ingrese los datos</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <form action="{{ url('/admin/arqueos/create_ingreso_egreso') }}" method="post">
                            @csrf
                            <input type="text" value="{{ $arqueo->id }}" name="id" hidden>
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fecha_apertura">Fecha de apertura</label>
                                        <input type="datetime-local" name="fecha_apertura" value="{{ $arqueo->fecha_apertura }}" class="form-control" disabled>
                                        @error('fecha_apertura')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tipo">Tipo de movimiento</label>
                                        <select name="tipo" id="" class="form-control">
                                            <option value="INGRESO">INGRESO</option>
                                            <option value="EGRESO">EGRESO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="monto">Monto</label>
                                        <input type="text" name="monto" value="{{ old('monto') }}" class="form-control">
                                        @error('monto')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="form-control">
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
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Registrar</button>
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