@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalles de la venta</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-9">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Datos registrados</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <table class="table table-striped table-sm table-bordered table-group-divider table-hover">
                                                <thead class="table-primary">
                                                    <tr style="text-align: center">
                                                        <th>Nro</th>
                                                        <th>Código</th>
                                                        <th>Cántidad</th>
                                                        <th>Nombre</th>
                                                        <th>Costo</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $contador = 1; $total_cantidad = 0; $total_venta = 0; ?>
                                                    
                                                    @foreach ($venta->detallesVenta as $detalle )
                                                        <tr>
                                                            <td style="text-align: center">{{ $contador++ }}</td>
                                                            <td style="text-align: center">{{ $detalle->producto->codigo }}</td>
                                                            <td style="text-align: center">{{ $detalle->cantidad }}</td>
                                                            <td style="text-align: center">{{ $detalle->producto->nombre }}</td>
                                                            <td style="text-align: center">{{ $detalle->producto->precio_venta }}</td>
                                                            <td style="text-align: center">{{ $total = $detalle->producto->precio_venta * $detalle->cantidad }}</td>
                                                        </tr>
                                                        @php
                                                            $total_cantidad += $detalle->cantidad;
                                                            $total_venta += $total;
                                                        @endphp
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td style="text-align: right" colspan="2"><b>Total cántidad</b></td>
                                                        <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>

                                                        <td style="text-align: right" colspan="2"><b>Precio Total</b></td>
                                                        <td style="text-align: center"><b>{{ $total_venta }}</b></td>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                            
                                        </div>

                                        <div class="col-md-4">

                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Nombre del cliente</label>
                                                    <!--en el value pregunto si existe el cliente que lo muestre, de lo contrario que me muestre vacio ya que es un campo que puede ser nulo-->
                                                    <input type="text" id="nombre_cliente_select" value="{{ $venta->cliente->nombre_cliente ?? 'S/N' }}" class="form-control" disabled>
                                                    <input type="text" id="id_cliente" class="form-control" name="cliente_id" hidden>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Código del cliente</label>
                                                    <!--en el value pregunto si existe el código que lo muestre, de lo contrario que me muestre vacio ya que es un campo que puede ser nulo-->
                                                    <input type="text" id="codigo_cliente_select" value="{{ $venta->cliente->codigo ?? '0' }}" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha</label>
                                                        <input type="date" name="fecha_compra" value="{{ $venta->fecha_venta }}" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="precio_total">Costo Total</label>
                                                        <input type="text" style="text-align: center; color:rgb(0, 0, 0); background-color:bisque" name="precio_total" value="{{ $total_venta }}" class="form-control" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <a href="{{ url('/admin/ventas') }}" class="btn btn-secondary btn-block">Volver</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        
                                    </div>

                                </div>

                            </div>
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

                    $('#table_proveedores').DataTable({
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