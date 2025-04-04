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
                            
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table id="table_permission" class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Nombre del Permiso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_permisos = 1; ?>
                                @foreach ($permisos as $permiso)
                                    <tr>
                                        <td style="text-align: center">{{ $contador_permisos++ }}</td>
                                        <td style="text-align: center">{{ $permiso->name }}</td>
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