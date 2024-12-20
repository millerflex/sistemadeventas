@extends('adminlte::page')

@section('content_header')
    <h1><b>Registro de un nuevo rol</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-4">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Datos registrados</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <form action="{{ url('/admin/roles', $rol->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nombre del rol</label>
                                        <input type="text" name="name" value="{{ $rol->name }}" class="form-control" required>
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
                                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Actualizar</button>
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