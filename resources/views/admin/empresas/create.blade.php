@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
    <div class="container">

        <br>

        {{-- Logo --}}
        <center>
            <img src="{{ asset('images/logo.jpg') }}" style="width: 250px" alt="">
        </center>
        <br>


        {{-- Card Box --}}
        <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

            {{-- Card Header --}}
            
                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h3 class="card-title float-none text-center">
                        <b>Registro de una nueva empresa</b>
                    </h3>
                </div>
            

            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                <form action="{{ url('crear_empresa/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control" name="logo" accept=".jpg, .jpeg, .png" id="file" required>
                                @error('logo')
                                    <small style="color:red;"> {{ $message }} </small>
                                @enderror
                                <!--Script para previsualizar la imagen a cargar en la base de datos-->
                                <output style="padding= 10px" id="list"></output>
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
                                                <option value="{{ $pais->id }}">{{ $pais->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="departamento">Estado/Provincia/Región</label>
                                        
                                            <div id="respuesta_pais">

                                            </div>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                            <div id="respuesta_estado">

                                            </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre_empresa">Nombre de la empresa</label>
                                        <input type="text" value="{{ old('nombre_empresa') }}" class="form-control" name="nombre_empresa" required>
                                        @error('nombre_empresa')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_empresa">Tipo de la empresa</label>
                                        <input type="text" value="{{ old('tipo_empresa') }}" class="form-control" name="tipo_empresa" required>
                                        @error('tipo_empresa')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nit">NIT</label>
                                        <input type="text" value="{{ old('nit') }}" name="nit" class="form-control" required>
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
                                                <option value="{{ $moneda->symbol }}">{{ $moneda->symbol }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre_impuesto">Nombre del impuesto</label>
                                        <input type="text" value="{{ old('nombre_impuesto') }}" class="form-control" name="nombre_impuesto" required>
                                        @error('nombre_impuesto')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cantidad_impuesto">%</label>
                                        <input type="number" value="{{ old('cantidad_impuesto') }}" name="cantidad_impuesto" class="form-control" required>
                                        @error('cantidad_impuesto')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono de la empresa</label>
                                        <input type="text" value="{{ old('telefono') }}" class="form-control" name="telefono" required>
                                        @error('telefono')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correo">Correo de la empresa</label>
                                        <input type="email" value="{{ old('correo') }}" class="form-control" name="correo" required>
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
                                        <input id="pac-input" value="{{ old('direccion') }}" type="text" name="direccion" class="form-control" placeholder="buscar..." required>
                                        @error('direccion')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                        <br>
                                        <div id="map" style="width: 100%; height: 400px"></div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo_postal">Código Postal</label>
                                        <select name="codigo_postal" class="form-control" id="" required>
                                            @foreach ($paises as $pais)
                                                <option value="{{ $pais->phone_code }}">{{ $pais->phone_code }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Crear empresa</button>
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

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&libraries=places&callback=initAutocomplete" async defer></script>

    <!--Script para mostrar el mapa de Google Maps-->
    <script>
        function initMap() {
        // Ubicación inicial y configuración del mapa
        const initialLocation = { lat: 40.7128, lng: -74.0060 }; // Nueva York, por ejemplo
        const map = new google.maps.Map(document.getElementById("map"), {
            center: initialLocation,
            zoom: 13,
        });
    
        // Campo de búsqueda de lugares
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
    
        // Ajuste del mapa según la búsqueda
        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });
    
        let markers = [];
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
    
            if (places.length === 0) return;
    
            // Limpia los marcadores anteriores
            markers.forEach(marker => marker.setMap(null));
            markers = [];
    
            const bounds = new google.maps.LatLngBounds();
    
            places.forEach(place => {
                if (!place.geometry || !place.geometry.location) return;
    
                // Crear un marcador para cada lugar
                const marker = new google.maps.Marker({
                    map,
                    title: place.name,
                    position: place.geometry.location,
                });
                markers.push(marker);
    
                if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
    
            map.fitBounds(bounds);
        });
    }
    
    // Inicializar el mapa cuando la página se carga
    window.onload = initMap;
    </script>

    <!--- Script para que al seleccionar un país se carguen sus provincias/estados respectivas --->
    <script>
        $('#select_pais').on('change', function (){
            
            //El valor del select que tiene los paises lo almaceno en la variable "pais"
            var id_pais = $('#select_pais').val()
            //lert(pais)
            if(id_pais){
                $.ajax({
                    url:"{{ url('/crear_empresa/pais') }}"+'/'+id_pais,
                    type:"GET",
                    success: function (data){
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
                    url:"{{ url('/crear_empresa/estado') }}"+'/'+id_estado,
                    type:"GET",
                    success: function (data){
                        $('#respuesta_estado').html(data);
                    }

                })
            }else{
                alert("Debe seleccionar una Ciudad")
            }
        })
    </script>

@stop
