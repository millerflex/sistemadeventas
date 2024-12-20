@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de usuarios</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            <a href="{{ url('/admin/usuarios/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Crear Usuario</a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table id="table_users" class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Rol del Usuario</th>
                                    <th scope="col" style="text-align: center">Nombre del Usuario</th>
                                    <th scope="col" style="text-align: center">Email</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_usuarios = 1; ?>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td style="text-align: center">{{ $contador_usuarios++ }}</td>
                                        {{-- El implode sirve para mostrar de manera correcta el nombre del rol ya que con el "pluck" me lo muestra como si fuere una cadena json --}}
                                        <td style="text-align: center">{{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                                        <td style="text-align: center">{{ $usuario->name }}</td>
                                        <td style="text-align: center">{{ $usuario->email }}</td>
                                        <td  style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/usuarios/show', $usuario->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/usuarios/'. $usuario->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>

                                                <form action="{{ url('/admin/usuarios', $usuario->id) }}" method="post" onclick="preguntar{{ $usuario->id }} (event)"
                                                                id="miFormulario{{ $usuario->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $usuario->id }} (event){
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
                                                            var form = $('#miFormulario{{ $usuario->id }}')
                                                            form.submit()
                                                        }
                                                        });
                                                    }
                                                    
                                                </script>

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
<script>
    $('#table_users').DataTable({
                        "pageLength": 5,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                                    "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Usuarios",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                            })
    
</script>
@stop