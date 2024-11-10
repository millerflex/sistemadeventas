@extends('adminlte::page')

@section('content_header')
    <h1>Configuraciones/Editar</h1>
    <hr>
@stop

@section('content')
    {{-- Card Box --}}
    <div class="card card-outline card-success">

        {{-- Card Header --}}
        
            <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                <h3 class="card-title float-none">
                    <b>Datos registrados</b>
                </h3>
            </div>
        

        {{-- Card Body --}}
        <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
            <form action="{{ url('/admin/configuracion', $empresa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control" name="logo" accept=".jpg, .jpeg, .png" id="file">
                            @error('logo')
                                <small style="color:red;"> {{ $message }} </small>
                            @enderror
                            <!--Script para previsualizar la imagen a cargar en la base de datos-->
                            <center>
                                <output style="padding= 10px" id="list">
                                    <img src="{{ asset('storage/'.$empresa->logo) }}" width="80%" alt="logo">
                                </output>
                            </center>
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

                    <div class="col-md-9">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pais">País</label>
                                    <select name="pais" id="select_pais" class="form-control" id="">
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}" {{ $empresa->pais == $pais->id ? 'selected' : '' }}>{{ $pais->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="departamento">Estado/Provincia/Región</label>
                                        <select name="estado" id="select_departamento2" class="form-control">
                                            @foreach($departamentos as $departamento)
                                                <option  value="{{ $departamento->id }}" {{ $empresa->departamento == $departamento->id ? 'selected' : '' }}>{{ $departamento->name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="respuesta_pais">

                                        </div>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ciudad">Ciudad</label>
                                        <select name="ciudad" id="select_ciudad_2" class="form-control">
                                            @foreach($ciudades as $ciudad)
                                                <option  value="{{ $ciudad->id }}" {{ $empresa->ciudad == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="respuesta_estado">

                                        </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombre_empresa">Nombre de la empresa</label>
                                    <input type="text" value="{{ $empresa->nombre_empresa }}" class="form-control" name="nombre_empresa" required>
                                    @error('nombre_empresa')
                                    <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tipo_empresa">Tipo de la empresa</label>
                                    <input type="text" value="{{ $empresa->tipo_empresa }}" class="form-control" name="tipo_empresa" required>
                                    @error('tipo_empresa')
                                    <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nit">NIT</label>
                                    <input type="text" value="{{ $empresa->nit}}" name="nit" class="form-control" required>
                                    @error('nit')
                                    <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="moneda">Moneda</label>
                                    <select name="moneda" class="form-control">
                                        @foreach($monedas as $moneda)
                                            <option value="{{ $moneda->id }}" {{ $empresa->moneda == $moneda->id ? 'selected' : '' }}>{{ $moneda->symbol }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombre_impuesto">Nombre del impuesto</label>
                                    <input type="text" value="{{ $empresa->nombre_impuesto }}" class="form-control" name="nombre_impuesto" required>
                                    @error('nombre_impuesto')
                                    <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="cantidad_impuesto">%</label>
                                    <input type="number" value="{{ $empresa->cantidad_impuesto }}" name="cantidad_impuesto" class="form-control" required>
                                    @error('cantidad_impuesto')
                                    <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="telefono">Teléfono de la empresa</label>
                                    <input type="text" value="{{ $empresa->telefono }}" class="form-control" name="telefono" required>
                                    @error('telefono')
                                    <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="correo">Correo de la empresa</label>
                                    <input type="email" value="{{ $empresa->correo }}" class="form-control" name="correo" required>
                                    @error('correo')
                                    <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input id="pac-input" value="{{ $empresa->direccion }}" type="text" name="direccion" class="form-control" placeholder="buscar..." required>
                                    @error('direccion')
                                    <small style="color:red;"> {{ $message }} </small>
                                    @enderror
                                    <br>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="codigo_postal">Código Postal</label>
                                    <select name="codigo_postal" class="form-control" id="" required>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->phone_code }}" {{ $empresa->codigo_postal == $pais->phone_code ? 'selected' : '' }}>{{ $pais->phone_code }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>

                        </div>

                        <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-lg btn-success btn-block">Actualizar datos</button>
                                </div>
                            </div>

                    </div>

                </div>

            </form>
        </div>

        {{-- Card Footer --}}
        @hasSection('auth_footer')
            <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                @yield('auth_footer')
            </div>
        @endif

    </div>
@stop

@section('css')
    
@stop

@section('js')

<!--- Script para que al seleccionar un país se carguen sus provincias/estados respectivas --->
<script>
    $('#select_pais').on('change', function (){
        
        //El valor del select que tiene los paises lo almaceno en la variable "pais"
        var id_pais = $('#select_pais').val()
        //lert(pais)
        if(id_pais){
            $.ajax({
                url:"{{ url('/admin/configuracion/pais') }}"+ '/' +id_pais,
                type:"GET",
                success: function (data){
                    $('#select_departamento2').css('display', 'none')
                    $('#respuesta_pais').html(data);
                }

            })
        }else{
            alert("Debe seleccionar un país")
        }
    })
</script>

<!--- Script para que al seleccionar un estado/provincia se carguen sus ciudades respectivas --->
<script>
    $(document).on('change', '#select_estado', function () {
        var id_estado = $(this).val()
        //alert(id_estado)

        if(id_estado){
            $.ajax({
                url:"{{ url('/admin/configuracion/estado') }}"+ '/' +id_estado,
                type:"GET",
                success: function (data){
                    $('#select_ciudad_2').css('display', 'none')
                    $('#respuesta_estado').html(data);
                    
                }

            })
        }else{
            alert("Debe seleccionar una Ciudad")
        }
    })
</script>
@stop