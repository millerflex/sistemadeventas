@extends('adminlte::page')

@section('content_header')
    <h1><b>Producto: {{ $producto->nombre }}</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ingrese los datos</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">
                        <form action="{{ url('/admin/productos',$producto->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Categoría</label>
                                                <select name="categoria_id" id="" class="form-control">
                                                    @foreach($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->categoria_id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="codigo">Código</label>
                                                <input type="text" name="codigo" value="{{ $producto->codigo }}" class="form-control" required>
                                                @error('codigo')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre">Nombre del producto</label>
                                                <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" required>
                                                @error('nombre')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripcion">Descripción</label>
                                                <textarea name="descripcion"id="" cols="30" rows="2" class="form-control"> {{ $producto->descripcion }}</textarea>
                                                @error('descripcion')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input type="number" name="stock" value="{{ $producto->stock }}" class="form-control" required>
                                                @error('stock')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stock_minimo">Stock mínimo</label>
                                                <input type="number" name="stock_minimo" value="{{ $producto->stock_minimo }}" class="form-control" required>
                                                @error('stock_minimo')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="stock_maximo">Stock máximo</label>
                                                <input type="number" name="stock_maximo" value="{{ $producto->stock_maximo }}" class="form-control" required>
                                                @error('stock_maximo')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="precio_compra">Precio compra</label>
                                                <input type="text" name="precio_compra" value="{{ $producto->precio_compra }}" class="form-control" required>
                                                @error('precio_compra')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="precio_venta">Precio venta</label>
                                                <input type="text" name="precio_venta" value="{{ $producto->precio_venta }}" class="form-control" required>
                                                @error('precio_venta')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fecha_ingreso">Fecha ingreso</label>
                                                <input type="date" name="fecha_ingreso" value="{{ $producto->fecha_ingreso }}" class="form-control" required>
                                                @error('fecha_ingreso')
                                                <small style="color:red;"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="logo">Imagen</label>
                                        <input type="file" class="form-control" name="imagen" accept=".jpg, .jpeg, .png" id="file"><br>
                                        @error('imagen')
                                            <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                        <!--Script para previsualizar la imagen a cargar en la base de datos-->
                                        <output style="padding= 10px" id="list"><img src="{{ asset('storage/'.$producto->imagen) }}" width="80px" alt="logo"></output>
                                        <br>
                                        <br>
                                        <script>
                                            function archivo(evt){
                                                var files = evt.target.files;
                                                //obtenemos la imagen del campo "file"
                                                for(var i=0,f; f= files[i]; i++){
                                                    //sólo admito imágenes
                                                    if(!f.type.match('image.*')){
                                                        continue
                                                    }
        
                                                    var reader = new FileReader()
                                                    reader.onload = (function (theFile){
                                                        return function(e){
                                                            //Insertamos la imagen
                                                            document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title= "',escape(theFile.name), '"/>'].join('')
                                                        }
                                                    }) (f)
                                                    reader.readAsDataURL(f)
                                                }
                                            }
                                                document.getElementById('file').addEventListener('change', archivo, false)
                                        </script>
                                    <!--Script para previsualizar la imagen a cargar en la base de datos-->
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">Volver</a>
                                        <button type="submit" class="btn btn-success"><i class="bi bi-arrow-clockwise"></i> Actualizar</button>
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
    
@stop