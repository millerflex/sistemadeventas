@extends('adminlte::page')

@section('content_header')
    <h1><b>Actualización del permiso</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-4">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ingrese los datos</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <form action="{{ url('/admin/permisos/'.$permiso->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nombre del permiso</label>
                                        <input type="text" name="name" value="{{ $permiso->name }}" class="form-control" required>
                                        @error('name')
                                        <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="bi bi-arrow-clockwise-save"></i> Actualizar</button>
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