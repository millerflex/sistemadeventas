@extends('adminlte::page')


@section('content_header')
    <h1><b>Asignar permisos al rol: {{ $rol->name }}</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Permisos registrados</h3>
                        
                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <form action="{{ url('/admin/roles/asignar',$rol->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <!---foreach para desplegar la agruprupación-->
                            @foreach ($permisos as $modulo => $grupoPermisos)
                                <div class="col-md-4">
                                    <h3>{{ $modulo }}</h3>
                                    <!----Este foreach va a desplegar en base a $modulo lo que el 'stripos' va buscando el prefijo-->
                                    @foreach ($grupoPermisos as $permiso)
                                        <div class="form-check">
                                            <!-- En el name = "permisos[]" vamos a almacenar los permisos en el array-->
                                            <input type="checkbox" class="form-check-input" name="permisos[]" value="{{ $permiso->id }}"
                                                {{$rol->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
                                            <label for="" class="form-check-label">{{ $permiso->name }}</label>
                                        </div>
                                    @endforeach
                                    <hr>
                                </div>
                            @endforeach

                            <hr>
                            <button type="submit" class="btn btn-primary">Guardar</button>
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
<script>
</script>
@stop