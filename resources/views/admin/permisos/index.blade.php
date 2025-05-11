@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de permisos</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Permisos registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            <a href="{{ url('/admin/permisos/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Crear Permiso</a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table id="table_permission" class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Nombre del Permiso</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_permisos = 1; ?>
                                @foreach ($permisos as $permiso)
                                    <tr>
                                        <td style="text-align: center">{{ $contador_permisos++ }}</td>
                                        <td style="text-align: center">{{ $permiso->name }}</td>
                                        <td  style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/permisos/show', $permiso->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                    @if ($permiso->name !== "ADMINISTRADOR")
                                                        <a href="{{ url('/admin/permisos/'. $permiso->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                                    @endif
                                                    @if ($permiso->name !== "ADMINISTRADOR")
                                                        <form action="{{ url('/admin/permisos', $permiso->id) }}" method="post" onclick="preguntar{{ $permiso->id }} (event)"
                                                                        id="miFormulario{{ $permiso->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                        </form>
                                                        <script>
                                                            function preguntar{{ $permiso->id }} (event){
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
                                                                    var form = $('#miFormulario{{ $permiso->id }}')
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
<script>
    $('#table_permission').DataTable({
                        "pageLength": 5,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Permisos",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Permisos",
                                    "infoFiltered": "(Filtrado de _MAX_ total Permisos)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Permisos",
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