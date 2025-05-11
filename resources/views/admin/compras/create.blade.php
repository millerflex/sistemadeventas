@extends('adminlte::page')

@section('content_header')
    <h1><b>Registro de una nueva compra</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-9">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ingrese los datos</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <form action="{{ url('/admin/compras/create') }}" id="form_compra" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="cantidad">Cántidad</label>
                                                        <input type="number" id="cantidad" style="text-align: center; background-color:#f0e2c0" name="cantidad" value="1" class="form-control" required>
                                                        @error('cantidad')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="codigo">Código</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="bi bi-upc"></i></span>
                                                        </div>
                                                        <input id="codigo" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div style="height: 32px"></div>

                                                        <button type="button"
                                                                class="btn btn-primary w-md-auto mb-2 mb-md-0 w-100 "
                                                                data-toggle="modal"
                                                                data-target="#productoModal">
                                                                <i class="bi bi-search"></i>
                                                        </button>

                                                        <button id="btn-agregar" type="button" class="btn btn-warning  w-100 d-block d-md-none" onclick="agregarAlCarrito()">
                                                            <i class="bi bi-cart-plus"></i>
                                                        </button>

                                                        <!---Modal para la búsqueda de productos--->
                                                        
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl" style="max-width: 100%">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Listado de productos</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                        <div class="modal-body">
                                                                            <table id="table_products" class="table table-striped table-hover table-sm dt-responsive nowrap" style="width: 100%">
                                                                                <thead class="thead-light">
                                                                                    <tr>
                                                                                        <th scope="col" style="text-align: center">Nro</th>
                                                                                        <th scope="col" style="text-align: center">Acción</th>
                                                                                        <th scope="col" style="text-align: center">Categoría</th>
                                                                                        <th scope="col" style="text-align: center">Código</th>
                                                                                        <th scope="col" style="text-align: center">Nombre</th>
                                                                                        <th scope="col" style="text-align: center">Descripción</th>
                                                                                        <th scope="col" style="text-align: center">Stock</th>
                                                                                        <th scope="col" style="text-align: center">Precio compra</th>
                                                                                        <th scope="col" style="text-align: center">Precio venta</th>
                                                                                        <th scope="col" style="text-align: center">Imagen</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php $contador_productos = 1; ?>
                                                                                    @foreach ($productos as $producto)
                                                                                        <tr>
                                                                                            <td style="text-align: center; vertical-align:middle">{{ $contador_productos++ }}</td>
                                                                                            <td style="text-align: center; vertical-align:middle">
                                                                                                <button type="button" class="btn btn-info btn-sm btn-seleccionar" data-id="{{ $producto->codigo }}">Seleccionar</button>
                                                                                            </td>
                                                                                            <td style="text-align: center; vertical-align:middle">{{ $producto->categoria->nombre }}</td>
                                                                                            <td style="text-align: center; vertical-align:middle">{{ $producto->codigo }}</td>
                                                                                            <td style="text-align: center; vertical-align:middle">{{ $producto->nombre }}</td>
                                                                                            <td style="text-align: center; vertical-align:middle">
                                                                                                <!--Este fragmento de código lo que hace es limitar hasta 100 caracteres un texto largo-->
                                                                                                {!!\Illuminate\Support\Str::limit($producto->descripcion, 100, '...')!!}
                                                                                            </td>
                                                                                            <td style="text-align: center; background-color:rgb(235, 225, 213); vertical-align:middle">{{ $producto->stock }}</td>
                                                                                            <td style="text-align: center; vertical-align:middle">{{ $producto->precio_compra }}</td>
                                                                                            <td style="text-align: center; vertical-align:middle">{{ $producto->precio_venta }}</td>
                                                                                            <td style="text-align: center; vertical-align:middle">
                                                                                                <img src="{{ asset('storage/'.$producto->imagen) }}" width="80px" alt="logo">
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                    
                                                                                </tbody>
                                                                                
                                                                            </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!---Modal para la búsqueda de productos--->

                                                        <a href="{{ url('/admin/productos/create') }}" type="button" class="btn btn-success w-md-auto mt-2 mb-md-0 w-100"><i class="bi bi-plus-circle"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">
                                                <table class="table table-striped table-sm table-bordered table-group-divider table-hover" style="width: 100%">
                                                    <thead class="table-primary">
                                                        <tr style="text-align: center">
                                                            <th>Nro</th>
                                                            <th>Código</th>
                                                            <th>Cántidad</th>
                                                            <th>Nombre</th>
                                                            <th>Costo</th>
                                                            <th>Total</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php $contador = 1; $total_cantidad = 0; $total_compra = 0; ?>
                                                        
                                                        @foreach ($tmp_compras as $tmp_compra )
                                                            <tr>
                                                                <td style="text-align: center">{{ $contador++ }}</td>
                                                                <td style="text-align: center">{{ $tmp_compra->producto->codigo }}</td>
                                                                <td style="text-align: center">{{ $tmp_compra->cantidad }}</td>
                                                                <td style="text-align: center">{{ $tmp_compra->producto->nombre }}</td>
                                                                <td style="text-align: center">{{ $tmp_compra->producto->precio_compra }}</td>
                                                                <td style="text-align: center">{{ $total = $tmp_compra->producto->precio_compra * $tmp_compra->cantidad }}</td>
                                                                <td style="text-align: center">
                                                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $tmp_compra->id }}"><i class="bi bi-trash3-fill"></i></button>
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $total_cantidad += $tmp_compra->cantidad;
                                                                $total_compra += $total;
                                                            @endphp
                                                        @endforeach
                                                    </tbody>

                                                    <tfoot>
                                                        <tr>
                                                            <td style="text-align: right" colspan="2"><b>Total cántidad</b></td>
                                                            <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>

                                                            <td style="text-align: right" colspan="2"><b>Precio Total</b></td>
                                                            <td style="text-align: center"><b>{{ $total_compra }}</b></td>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary w-md-auto mb-1 mb-md-0" data-toggle="modal" data-target="#proveedorModal">Buscar proveedor</button>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" id="nombre_proveedor" class="form-control" readonly>
                                                    <input type="text" id="id_proveedor" class="form-control" name="proveedor_id" hidden>
                                                </div>

                                                <!-- Modal para la búsqueda de proveedores-->
                                                <div class="modal fade" id="proveedorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Listado de proveedores</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                                <div class="modal-body">
                                                                    <table id="table_proveedores" class="table table-striped table-hover table-sm dt-responsive nowrap" style="width: 100%">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                                <th scope="col" style="text-align: center">Nro</th>
                                                                                <th scope="col" style="text-align: center">Acción</th>
                                                                                <th scope="col" style="text-align: center">Empresa</th>
                                                                                <th scope="col" style="text-align: center">Teléfono</th>
                                                                                <th scope="col" style="text-align: center">Nombre</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php $contador_proveedores = 1; ?>
                                                                            @foreach ($proveedores as $proveedor)
                                                                                <tr>
                                                                                    <td style="text-align: center; vertical-align:middle">{{ $contador_proveedores++ }}</td>
                                                                                    <td style="text-align: center; vertical-align:middle">
                                                                                        <button type="button" class="btn btn-info btn-sm btn-seleccionar-proveedor" data-id="{{ $proveedor->id }}" data-empresa="{{ $proveedor->empresa }}">Seleccionar</button>
                                                                                    </td>
                                                                                    <td style="text-align: center; vertical-align:middle">{{ $proveedor->empresa }}</td>
                                                                                    <td style="text-align: center; vertical-align:middle">{{ $proveedor->telefono }}</td>
                                                                                    <td style="text-align: center; vertical-align:middle">{{ $proveedor->nombre }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            
                                                                        </tbody>
                                                                        
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!---Modal para la búsqueda de proveedores--->

                                                <div class="col-md-6">

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha</label>
                                                        <input type="date" name="fecha_compra" value="{{ old('fecha') }}" class="form-control">
                                                        @error('fecha')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="comprobante">Comprobante</label>
                                                        <input type="text" name="comprobante" value="{{ old('comprobante') }}" class="form-control">
                                                        @error('comprobante')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="precio_total">Costo Total</label>
                                                        <input type="text" style="text-align: center; color:rgb(0, 0, 0); background-color:bisque" name="precio_total" value="{{ $total_compra }}" class="form-control" readonly>
                                                        @error('precio_total')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-save"></i> Registrar compra</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        
                                    </div>

                                </div>

                            </div>

                        </form>
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

            //Función para agregar productos al carrito pero con el botón agregar que va a aparecer cuando el sistema esté en móvil
            function agregarAlCarrito(){
                var codigo = $('#codigo').val()
                var cantidad = $('#cantidad').val()
                
                if(codigo.length > 0){
                    $.ajax({
                        url: "{{ route('admin.compras.tmp_compras') }}",
                        method: 'POST',
                        data:{
                            _token:'{{ csrf_token() }}',
                            codigo: codigo,
                            cantidad: cantidad
                        },
                        success:function(response){
                            if(response.success){
                                Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "El producto se agregó correctamente",
                                showConfirmButton: false,
                                timer: 4000
                                });

                                location.reload(); //La página se va a refrescar automáticamente al registrarse el producto

                            }else{
                                Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "El producto no encontrado en la base de datos",
                                showConfirmButton: false,
                                timer: 4000
                                });
                            }
                        },

                        error:function(error){
                            alert (error)
                        }
                    })
                }
            }

            //Función para que al apretar el botón "seleccionar" se ingrese el nombre del proveedor dentro del input
            $('.btn-seleccionar-proveedor').click(function(){
                var id_proveedor = $(this).data('id')
                var empresa = $(this).data('empresa')
                $('#nombre_proveedor').val(empresa)
                $('#id_proveedor').val(id_proveedor)
                $('#proveedorModal').modal('hide');
                $('#proveedorModal').on('hidden.bs.modal', function(){
                    $('#nombre_proveedor').focus()
                });
                
                //alert(id_proveedor)

            })
            //Función para que al apretar el botón "seleccionar" se ingrese el nombre del proveedor dentro del input

            //Función para que al apretar el botón "seleccionar" el código del producto se pase al input "código"
            $('.btn-seleccionar').click(function(){
                var id_producto = $(this).data('id')
                $('#codigo').val(id_producto)
                $('#productoModal').modal('hide');
                $('#productoModal').on('hidden.bs.modal', function(){
                    $('#codigo').focus()
                });
                
                //alert(id)

            })

            //Función para eliminar los registros de la tabla
            $('.delete-btn').click( function(){
                var id = $(this).data('id')

                if(id){
                    $.ajax({
                            url: "{{ url('/admin/compras/create/tmp') }}/"+id,
                            type: 'POST',
                            data:{
                                _token:'{{ csrf_token() }}',
                                _method:'DELETE'
                                
                            },
                            success:function(response){
                                if(response.success){
                                    Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Producto eliminado",
                                    showConfirmButton: false,
                                    timer: 4000
                                    });

                                    location.reload(); //La página se va a refrescar automáticamente al registrarse el producto

                                }else{
                                    Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "El producto no se pudo eliminar",
                                    showConfirmButton: false,
                                    timer: 4000
                                    });
                                }
                            },

                            error:function(error){
                                alert (error)
                            }
                        })
                }
            })
            //Función para eliminar los registros de la tabla

            $('#codigo').focus() //Para que el cursor esté automáticamente dentro del INPUT del código


            //Script para que al presionar la tecla ENTER no se habilite el envío del formulario
            $('#form_compra').on('keypress', function(e){
                if(e.keyCode === 13){
                    e.preventDefault()
                }
            })
            //Script para que al presionar la tecla ENTER no se habilite el envío del formulario
            

            //Script para que al ingresar el código del producto, este se cargue de forma automática en la tabla
            $('#codigo').on('keyup', function(e){

                //13 equivale al código ascii que es igual al ENTER
                if(e.which === 13){

                    var codigo = $(this).val()
                    var cantidad = $('#cantidad').val()
                
                    if(codigo.length > 0){
                        $.ajax({
                            url: "{{ route('admin.compras.tmp_compras') }}",
                            method: 'POST',
                            data:{
                                _token:'{{ csrf_token() }}',
                                codigo: codigo,
                                cantidad: cantidad
                            },
                            success:function(response){
                                if(response.success){
                                    Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "El producto se agregó correctamente",
                                    showConfirmButton: false,
                                    timer: 4000
                                    });

                                    location.reload(); //La página se va a refrescar automáticamente al registrarse el producto

                                }else{
                                    Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "El producto no encontrado en la base de datos",
                                    showConfirmButton: false,
                                    timer: 4000
                                    });
                                }
                            },

                            error:function(error){
                                alert (error)
                            }
                        })
                    }
                }
            
            })
        </script>

<script>

//Script para que la tabla productos que se encuentra dentro del modal sea responsiva
    $('#productoModal').on('shown.bs.modal', function () {
        $('#table_products').DataTable().columns.adjust().responsive.recalc();
    });

    //Script para que la tabla proveedores que se encuentra dentro del modal sea responsiva
    $('#proveedorModal').on('shown.bs.modal', function () {
        $('#table_proveedores').DataTable().columns.adjust().responsive.recalc();
    });

    $('#table_products').DataTable({
                            "responsive": true,
                            "autoWidth": false,
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

                    $('#table_proveedores').DataTable({
                            "responsive": true,
                            "autoWidth": false,
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