@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de productos</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Productos registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            <a href="{{ url('/admin/productos/reporte') }}" class="btn btn-danger btn-sm" target="blank"><i class="bi bi-filetype-pdf"></i> Reporte</a>
                            <a href="{{ url('/admin/productos/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Crear Producto</a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table id="table_products" class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Categoría</th>
                                    <th scope="col" style="text-align: center">Código</th>
                                    <th scope="col" style="text-align: center">Nombre</th>
                                    <th scope="col" style="text-align: center">Descripción</th>
                                    <th scope="col" style="text-align: center">Stock</th>
                                    <th scope="col" style="text-align: center">Precio compra</th>
                                    <th scope="col" style="text-align: center">Precio venta</th>
                                    <th scope="col" style="text-align: center">Imagen</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_productos = 1; ?>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td style="text-align: center; vertical-align:middle">{{ $contador_productos++ }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $producto->categoria->nombre }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $producto->codigo }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $producto->nombre }}</td>
                                        <td style="text-align: center; vertical-align:middle">
                                            <!--Este fragmento de código lo que hace es limitar hasta 100 caracteres un texto largo-->
                                            {!!\Illuminate\Support\Str::limit($producto->descripcion, 100, '...')!!}
                                        </td>
                                        <td style="text-align: center; background-color:tan; vertical-align:middle">{{ $producto->stock }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $producto->precio_compra }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $producto->precio_venta }}</td>
                                        <td style="text-align: center; vertical-align:middle">
                                            <img src="{{ asset('storage/'.$producto->imagen) }}" width="80px" alt="logo">
                                        </td>
                                        <td style="text-align: center; vertical-align:middle">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/productos/show', $producto->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/productos/'. $producto->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>

                                                <form action="{{ url('/admin/productos', $producto->id) }}" method="post" onclick="preguntar{{ $producto->id }} (event)"
                                                                id="miFormulario{{ $producto->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $producto->id }} (event){
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
                                                            var form = $('#miFormulario{{ $producto->id }}')
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                                        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Productos",
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