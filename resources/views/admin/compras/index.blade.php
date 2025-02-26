@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de compras</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Compras registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            @if ($arqueoAbierto)
                                <a href="{{ url('/admin/compras/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Cargar compra</a>
                            @else
                                <a href="{{ url('/admin/arqueos/create') }}" class="btn btn-danger btn-sm"><i class="bi bi-plus-circle"></i> Abrir caja</a>
                            @endif
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table id="table_products" class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Fecha</th>
                                    <th scope="col" style="text-align: center">Comprobante</th>
                                    <th scope="col" style="text-align: center">Precio total</th>
                                    <th scope="col" style="text-align: center">Productos</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_compras = 1; ?>
                                @foreach ($compras as $compra)
                                    <tr>
                                        <td style="text-align: center; vertical-align:middle">{{ $contador_compras++ }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $compra->fecha_compra }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $compra->comprobante }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $compra->precio_total }}</td>
                                        <td style="vertical-align:middle">
                                            <ul>
                                                @foreach ($compra->detalles as $detalle)
                                                    <li>{{ $detalle->producto->nombre." - ".$detalle->cantidad." Unidades" }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td style="text-align: center; vertical-align:middle">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/compras/show', $compra->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/compras/'. $compra->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>

                                                <form action="{{ url('/admin/compras', $compra->id) }}" method="post" onclick="preguntar{{ $compra->id }} (event)"
                                                                id="miFormulario{{ $compra->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $compra->id }} (event){
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
                                                            var form = $('#miFormulario{{ $compra->id }}')
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Compras",
                                        "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Compras",
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