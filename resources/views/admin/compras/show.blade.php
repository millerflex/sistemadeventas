@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalles de la compra</b></h1>
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
                                                    <?php $contador = 1; $total_cantidad = 0; $total_compra = 0; ?>
                                                    
                                                    @foreach ($compra->detalles as $detalle )
                                                        <tr>
                                                            <td style="text-align: center">{{ $contador++ }}</td>
                                                            <td style="text-align: center">{{ $detalle->producto->codigo }}</td>
                                                            <td style="text-align: center">{{ $detalle->cantidad }}</td>
                                                            <td style="text-align: center">{{ $detalle->producto->nombre }}</td>
                                                            <td style="text-align: center">{{ $detalle->producto->precio_compra }}</td>
                                                            <td style="text-align: center">{{ $total = $detalle->producto->precio_compra * $detalle->cantidad }}</td>
                                                        </tr>
                                                        @php
                                                            $total_cantidad += $detalle->cantidad;
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

                                        <div class="col-md-4">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">Proveedor</label>
                                                    {{-- de la variable compra voy a los detalles, de los detalles saco el primer valor con el first() y luego voy a proveedor y empresa --}}
                                                    <input type="text" id="nombre_proveedor" value="{{ $compra->proveedor->empresa }}" class="form-control" readonly>
                                                </div>

                                                <div class="col-md-6">

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha</label>
                                                        <input type="date" name="fecha_compra" value="{{ $compra->fecha_compra }}" class="form-control" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="comprobante">Comprobante</label>
                                                        <input type="text" name="comprobante" value="{{ $compra->comprobante }}" class="form-control" disabled>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="precio_total">Costo Total</label>
                                                        <input type="text" style="text-align: center; color:rgb(0, 0, 0); background-color:bisque" name="precio_total" value="{{ $total_compra }}" class="form-control" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <a href="{{ url('/admin/compras') }}" class="btn btn-secondary btn-block">Volver</a>
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