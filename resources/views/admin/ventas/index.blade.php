@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de ventas</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ventas registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            <a href="{{ url('/admin/ventas/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Cargar venta</a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table id="table_products" class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Fecha</th>
                                    <th scope="col" style="text-align: center">Precio total</th>
                                    <th scope="col" style="text-align: center">Productos</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_venta = 1; ?>
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td style="text-align: center; vertical-align:middle">{{ $contador_venta++ }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $venta->fecha_venta }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $venta->precio_total }}</td>
                                        <td style="vertical-align:middle">
                                            <ul>
                                                @foreach ($venta->detallesVenta as $detalle)
                                                    <li>{{ $detalle->producto->nombre." - ".$detalle->cantidad." Unidades" }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td style="text-align: center; vertical-align:middle">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/ventas/show', $venta->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/ventas/'. $venta->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="{{ url('/admin/ventas/pdf/'. $venta->id) }}" target="_blank" class="btn btn-warning btn-sm"><i class="bi bi-printer"></i></a>

                                                <form action="{{ url('/admin/ventas', $venta->id) }}" method="post" onclick="preguntar{{ $venta->id }} (event)"
                                                                id="miFormulario{{ $venta->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $venta->id }} (event){
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
                                                            var form = $('#miFormulario{{ $venta->id }}')
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
        $('#table_products').DataTable({
                            "pageLength": 5,
                                    "language": {
                                        "emptyTable": "No hay información",
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Ventas",
                                        "infoFiltered": "(Filtrado de _MAX_ total Ventas)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Ventas",
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