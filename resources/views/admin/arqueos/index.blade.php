@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de arqueo de caja</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Arqueos registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            <a href="{{ url('/admin/arqueos/reporte') }}" class="btn btn-danger btn-sm" target="blank"><i class="bi bi-filetype-pdf"></i> Reporte</a>
                            @if ($arqueoAbierto)
                            @else
                            <a href="{{ url('/admin/arqueos/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Crear Arqueo</a>
                            @endif

                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table id="table_users" class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Fecha de apertura</th>
                                    <th scope="col" style="text-align: center">Monto Inicial</th>
                                    <th scope="col" style="text-align: center">Fecha de cierre</th>
                                    <th scope="col" style="text-align: center">Monto Final</th>
                                    <th scope="col" style="text-align: center">Descripción</th>
                                    <th scope="col" style="text-align: center">Movimientos</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $contador_arqueo = 1;
                                @endphp

                                @foreach ($arqueos as $arqueo)
                                    <tr>
                                        <td style="text-align: center">{{ $contador_arqueo++ }}</td>
                                        <td style="text-align: center">{{ $arqueo->fecha_apertura }}</td>
                                        <td style="text-align: center">{{ $arqueo->monto_inicial }}</td>
                                        <td style="text-align: center">{{ $arqueo->fecha_cierre }}</td>
                                        <td style="text-align: center">{{ $arqueo->monto_final }}</td>
                                        <td style="text-align: center">{{ $arqueo->descripcion }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b>Ingresos</b><br>
                                                    {{ number_format($arqueo->total_ingresos, 2) }} <!--Lleva el 2 para que tenga 2 decimales-->
                                                </div>

                                                <div class="col-md-6">
                                                    <b>Egresos</b><br>
                                                    {{ number_format($arqueo->total_egresos, 2) }}
                                                </div>

                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/arqueos/show', $arqueo->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/arqueos/'. $arqueo->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="{{ url('/admin/arqueos/'. $arqueo->id .'/ingreso-egreso') }}" class="btn btn-warning btn-sm"><i class="bi bi-file-spreadsheet"></i></a>
                                                <a href="{{ url('/admin/arqueos/'. $arqueo->id .'/cierre') }}" class="btn btn-secondary btn-sm"><i class="bi bi-lock"></i></a>
                                                <form action="{{ url('/admin/arqueos', $arqueo->id) }}" method="post" onclick="preguntar{{ $arqueo->id }} (event)"
                                                                id="miFormulario{{ $arqueo->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $arqueo->id }} (event){
                                                        event.preventDefault()
                                                        Swal.fire({
                                                        title: "¿Estás seguro de eliminar este registro de la base de datos?",
                                                        text: "Si eliminas este registro se perderán todos los movimientos realizados en este arqueo",
                                                        icon: "question",
                                                        showDenyButton: true,
                                                        showCancelButton: false,
                                                        confirmButtonText: "Eliminar",
                                                        denyButtonText: `No eliminar`
                                                        }).then((result) => {
                                                        /* Read more about isConfirmed, isDenied below */
                                                        if (result.isConfirmed) {
                                                            var form = $('#miFormulario{{ $arqueo->id }}')
                                                            form.submit()
                                                        }
                                                        });
                                                    }
                                                    
                                                </script>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Arqueo",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Arqueo",
                                    "infoFiltered": "(Filtrado de _MAX_ total Arqueo)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Arqueo",
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