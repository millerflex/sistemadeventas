@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de roles</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Roles registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            <a href="{{ url('/admin/roles/reporte') }}" class="btn btn-danger btn-sm" target="blank"><i class="bi bi-filetype-pdf"></i> Reporte</a>
                            <a href="{{ url('/admin/roles/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Crear Rol</a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Nombre del Rol</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_rol = 1; ?>
                                @foreach ($roles as $rol)
                                    <tr>
                                        <td style="text-align: center">{{ $contador_rol++ }}</td>
                                        <td style="text-align: center">{{ $rol->name }}</td>
                                        <td  style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/roles/show', $rol->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    @if ($rol->name !== "ADMINISTRADOR")
                                                        <a href="{{ url('/admin/roles/'. $rol->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                                    @endif
                                                <a href="{{ url('/admin/roles/'. $rol->id .'/asignar') }}" class="btn btn-warning btn-sm"><i class="bi bi-person-fill-lock"></i></a>
                                                    @if ($rol->name !== "ADMINISTRADOR")
                                                        <form action="{{ url('/admin/roles', $rol->id) }}" method="post" onclick="preguntar{{ $rol->id }} (event)"
                                                                        id="miFormulario{{ $rol->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                        </form>
                                                        <script>
                                                            function preguntar{{ $rol->id }} (event){
                                                                event.preventDefault()
                                                                Swal.fire({
                                                                title: "¿Estás seguro de eliminar este registro de la base de datos?",
                                                                icon: "question",
                                                                showDenyButton: true,
                                                                showCancelButton: false,
                                                                confirmButtonText: "Eliminar",
                                                                denyButtonText: `No eliminar`
                                                                }).then((result) => {
                                                                /* Read more about isConfirmed, isDenied below */
                                                                if (result.isConfirmed) {
                                                                    var form = $('#miFormulario{{ $rol->id }}')
                                                                    form.submit()
                                                                }
                                                                });
                                                            }
                                                            
                                                        </script>
                                                    @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                            
                        </table>
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