@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de clientes</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-10">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Clientes registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            <a href="{{ url('/admin/clientes/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Crear Cliente</a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table class="table table-striped table-hover table-sm" id="table_clients">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Nombre del Cliente</th>
                                    <th scope="col" style="text-align: center">Código del cliente</th>
                                    <th scope="col" style="text-align: center">Teléfono</th>
                                    <th scope="col" style="text-align: center">Email</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_cliente = 1; ?>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td style="text-align: center">{{ $contador_cliente++ }}</td>
                                        <td style="text-align: center">{{ $cliente->nombre_cliente }}</td>
                                        <td style="text-align: center">{{ $cliente->codigo }}</td>
                                        <td style="text-align: center">{{ $cliente->telefono }}</td>
                                        <td style="text-align: center">{{ $cliente->email }}</td>
                                        <td  style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/clientes/show', $cliente->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/clientes/'. $cliente->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>

                                                <form action="{{ url('/admin/clientes', $cliente->id) }}" method="post" onclick="preguntar{{ $cliente->id }} (event)"
                                                                id="miFormulario{{ $cliente->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $cliente->id }} (event){
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
                                                            var form = $('#miFormulario{{ $cliente->id }}')
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
    $('#table_clients').DataTable({
                        "pageLength": 5,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                                    "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Clientes",
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