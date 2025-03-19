@extends('adminlte::page')


@section('content_header')
    <h1><b>Listado de categorías</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Categorías registrados</h3>
                        <!-- /.card-tools -->

                        <div class="card-tools">
                            <a href="{{ url('/admin/categorias/reporte') }}" class="btn btn-danger btn-sm" target="blank"><i class="bi bi-filetype-pdf"></i> Reporte</a>
                            <a href="{{ url('/admin/categorias/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Crear Categoría</a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">Nro</th>
                                    <th scope="col" style="text-align: center">Nombre de la categoría</th>
                                    <th scope="col" style="text-align: center">Descripción</th>
                                    <th scope="col" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador_categoria = 1; ?>
                                @foreach ($categorias as $categoria)
                                    <tr>
                                        <td style="text-align: center">{{ $contador_categoria++ }}</td>
                                        <td style="text-align: center">{{ $categoria->nombre }}</td>
                                        <td style="text-align: center">{{ $categoria->descripcion }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ url('/admin/categorias/show', $categoria->id )}}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ url('/admin/categorias/'. $categoria->id .'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-fill"></i></a>

                                                <form action="{{ url('/admin/categorias', $categoria->id) }}" method="post" onclick="preguntar{{ $categoria->id }} (event)"
                                                                id="miFormulario{{ $categoria->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="bi bi-trash3-fill"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $categoria->id }} (event){
                                                        event.preventDefault()
                                                        Swal.fire({
                                                        title: "¿Estás seguro de eliminar este registro de la base de datos? Si elimina esta categoría, todos los productos que están relacionados a ella también se eliminarán",
                                                        icon: "question",
                                                        showDenyButton: true,
                                                        showCancelButton: false,
                                                        confirmButtonText: "Eliminar",
                                                        denyButtonText: `No eliminar`
                                                        }).then((result) => {
                                                        /* Read more about isConfirmed, isDenied below */
                                                        if (result.isConfirmed) {
                                                            var form = $('#miFormulario{{ $categoria->id }}')
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
    
@stop