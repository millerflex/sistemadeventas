@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de Proveedores</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Proveedores registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            <a href="{{ url('/admin/proveedores/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Agregar Proveedor</a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table id="table_products" class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Empresa</th>
                                    <th scope="col" style="text-align: center">Dirección</th>
                                    <th scope="col" style="text-align: center">Teléfono</th>
                                    <th scope="col" style="text-align: center">Email</th>
                                    <th scope="col" style="text-align: center">Nombre del proveedor</th>
                                    <th scope="col" style="text-align: center">Celular del proveedor</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_proveedor = 1; ?>
                                @foreach ($proveedores as $proveedor)
                                    <tr>
                                        <td style="text-align: center; vertical-align:middle">{{ $contador_proveedor++ }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $proveedor->empresa }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $proveedor->direccion }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $proveedor->telefono }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $proveedor->email }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $proveedor->nombre }}</td>
                                        <td style="text-align: center; vertical-align:middle">{{ $proveedor->celular }}</td>                                   
                                        
                                        <td style="text-align: center; vertical-align:middle">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/proveedores/show', $proveedor->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/proveedores/'. $proveedor->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>

                                                <form action="{{ url('/admin/proveedores', $proveedor->id) }}" method="post" onclick="preguntar{{ $proveedor->id }} (event)"
                                                                id="miFormulario{{ $proveedor->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $proveedor->id }} (event){
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
                                                            var form = $('#miFormulario{{ $proveedor->id }}')
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                                        "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Proveedores",
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