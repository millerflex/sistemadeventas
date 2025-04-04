@extends('adminlte::page')

@section('content_header')
    <h1><b>Modificar datos del usuario</b></h1>
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
                        <form action="{{ url('/admin/usuarios', $usuario->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Nombre del rol</label>
                                        <select name="role" id="" class="form-control">
                                            @foreach($roles as $rol)
                                                <option value="{{ $rol->name }}" {{ $rol->name == $usuario->roles->pluck('name')->implode(', ') ? 'selected' : '' }}>{{ $rol->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Nombre del ususario</label>
                                        @if ($usuario->name == 'Admin')
                                            <input type="text" value="{{ $usuario->name }}" class="form-control" disabled>
                                            <input type="text" name="name" value="{{ $usuario->name }}" class="form-control" hidden>
                                        @else
                                            <input type="text" name="name" value="{{ $usuario->name }}" class="form-control" required>
                                        @endif
                                        @error('name')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="email" name="email" value="{{ $usuario->email }}" class="form-control" required>
                                        @error('email')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}" class="form-control" >
                                        @error('password')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">Volver</a>
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