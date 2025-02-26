@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalles del Arqueo</b></h1>
    <hr>
@stop

@section('content')
        <div class="row">
            <div class="col-md-4">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Datos registrados</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">

                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fecha_apertura">Fecha de apertura</label>
                                        <input type="datetime-local" name="fecha_apertura" value="{{ $arqueo->fecha_apertura }}" class="form-control" disabled>
                                        @error('fecha_apertura')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="monto_inicial">Monto Inicial</label>
                                        <input type="text" name="monto_inicial" value="{{ $arqueo->monto_inicial }}" class="form-control" disabled>
                                        @error('monto_inicial')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fecha_cierre">Fecha de cierre</label>
                                        <input type="datetime-local" name="fecha_cierre" value="{{ $arqueo->fecha_cierre }}" class="form-control" disabled>
                                        @error('fecha_cierre')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="monto_final">Monto Final</label>
                                        <input type="text" name="monto_final" value="{{ $arqueo->monto_final }}" class="form-control" disabled>
                                        @error('monto_final')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input type="text" name="descripcion" value="{{ $arqueo->descripcion }}" class="form-control" disabled>
                                        @error('descripcion')
                                        <small style="color:red;"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ url('/admin/arqueos') }}" class="btn btn-secondary">Volver</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-4">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ingresos</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">

                        <table class="table table-bordered table-hover table-sm table-striped">

                            <thead style="text-align: center">
                                <tr>
                                    <th>Nro</th>
                                    <th>Detalle</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>

                            <tbody style="text-align: center">
                                <?php
                                    $contador = 1;
                                    $suma_monto = 0;  
                                ?>

                                @foreach ($movimientos as $movimiento)

                                @if ($movimiento->tipo == 'INGRESO')

                                    @php
                                        $suma_monto += $movimiento->monto;
                                    @endphp

                                    <tr>
                                        <td>{{ $contador++ }}</td>
                                        <td>{{ $movimiento->descripcion }}</td>
                                        <td>{{ $movimiento->monto }}</td>
                                    </tr>

                                @endif
                                    
                                @endforeach

                            </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: center"><b>Total</b></td>
                                        <td style="text-align: center"><b>{{ $suma_monto }}</b></td>
                                    </tr>
                                </tfoot>

                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-4">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Egresos</h3>
                        <!-- /.card-tools -->

                    </div>
                    <!-- /.card-header -->
                    

                    <div class="card-body">

                        <table class="table table-bordered table-hover table-sm table-striped">

                            <thead style="text-align: center">
                                <tr>
                                    <th>Nro</th>
                                    <th>Detalle</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>

                            <tbody style="text-align: center">
                                <?php
                                    $contador = 1;
                                    $suma_monto = 0;  
                                ?>

                                @foreach ($movimientos as $movimiento)

                                @if ($movimiento->tipo == 'EGRESO')

                                    @php
                                        $suma_monto += $movimiento->monto;
                                    @endphp

                                    <tr>
                                        <td>{{ $contador++ }}</td>
                                        <td>{{ $movimiento->descripcion }}</td>
                                        <td>{{ $movimiento->monto }}</td>
                                    </tr>

                                @endif
                                    
                                @endforeach

                            </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: center"><b>Total</b></td>
                                        <td style="text-align: center"><b>{{ $suma_monto }}</b></td>
                                    </tr>
                                </tfoot>
                                
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