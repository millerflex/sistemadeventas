<!doctype html>
<html lang="es">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt; /*Ajusta el tamaño*/
            color: #333; /*Cambia el color de la fuente*/
        }

        .table{
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered{
            border: 1px solid #000000;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000000;
        }

        .table-bordered thead th {
            border-bottom-width: 2px;
        }

    </style>

    <title>Sistema de ventas</title>
    </head>

<body>
    <table border="0" style="font-size: 8pt">
        <tr>
            <td style="text-align: center">
                <img src="{{ public_path('storage/'.$empresa->logo) }}" width="100px" alt="logo">
            </td>
            <td width="500px"></td>
            <td style="text-align: center">
                <b>NIT:</b>
                {{ $empresa->nit }}
                <b>Nro. Factura</b>
                {{ $venta->id }}
            </td>
        </tr>

        <tr>
            <td style="text-align: center">
                {{ $empresa->nombre_empresa }} <br>
                Tel: {{ $empresa->telefono }} <br>
                {{ $empresa->correo }} <br>
                {{ $empresa->direccion }} <br>
            </td>

            <td style="text-align: center" width="500px">
                <h1>FACTURA</h1>
            </td>
            <td style="text-align: center"><h4>ORIGINAL</h4></td>
        </tr>

    </table>

    <br>

    <?php 
        $fecha_db = $venta->fecha_venta;

        //Convertimos la fecha en el formato deseado
        $fecha_formateada = date("d", strtotime($fecha_db)). " de " .
                            date("F", strtotime($fecha_db)). " de " .
                            date("Y", strtotime($fecha_db));

        //Creamos un array asociativo para que los meses que están en Inglés se pasen a español
        $meses = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        ];
        
        $fecha_formateada = str_replace(array_keys($meses), array_values($meses), $fecha_formateada);
    ?>

    <div style="border: 1.5px solid black">
        <table border="0" cellpadding="6">
            <tr>
                <td width="400px"><b>Fecha: </b>{{ $fecha_formateada }}</td>
                <td width="100px"></td>
                <!-- ?-> (Null safe operation, esto se utiliza para que si el código del cliente es nulo, no me muestre un error sino un 0 por defecto)-->
                <td><b>Código cliente: </b>{{ $venta->cliente?->codigo ?? '0'}}</td>
            </tr>
    
            <tr>
                <td><b>Nombre cliente: </b>{{ $venta->cliente?->nombre_cliente ?? 'N/A' }}</td>
            </tr>
    
        </table>
    </div>

    <br>

    <table border="0">
        <tr>
            <td width="30px" style="background-color: #cccccc; text-align:center"><b>Nro</b></td>
            <td width="150px" style="background-color: #cccccc; text-align:center"><b>Producto</b></td>
            <td width="190px" style="background-color: #cccccc; text-align:center"><b>Descripción</b></td>
            <td width="90px" style="background-color: #cccccc; text-align:center"><b>Cántidad</b></td>
            <td width="110px" style="background-color: #cccccc; text-align:center"><b>Precio Unitario</b></td>
            <td width="90px" style="background-color: #cccccc; text-align:center"><b>SubTotal</b></td>
        </tr>
        @php
            $contador_detalles = 1;
            $subtotal = 0;
            $suma_cantidad = 0;
            $suma_precio_unitario = 0;
            $suma_subtotal = 0;
        @endphp

        <tbody>
            @foreach ($venta->detallesVenta as $detalle)

            @php
            $subtotal = $detalle->cantidad * $detalle->producto->precio_venta;
            $suma_cantidad += $detalle->cantidad;
            $suma_precio_unitario += $detalle->producto->precio_venta;
            $suma_subtotal += $subtotal;
            @endphp
                <tr>
                    <td style="text-align: center">{{ $contador_detalles++ }}</td>
                    <td style="text-align: center">{{ $detalle->producto->nombre }}</td>
                    <td style="text-align: center">{{ $detalle->producto->descripcion }}</td>
                    <td style="text-align: center">{{ $detalle->cantidad }}</td>
                    <td style="text-align: center">{{ $moneda->symbol." ".$detalle->producto->precio_venta }}</td>
                    <td style="text-align: center">{{ $moneda->symbol." ".$subtotal }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="3" style="background-color: #cccccc; text-align:center"><b>Total</b></td>
                <td width="90px" style="background-color: #cccccc; text-align:center"><b>{{ $suma_cantidad }}</b></td>
                <td width="110px" style="background-color: #cccccc; text-align:center"><b>{{$moneda->symbol." ". $suma_precio_unitario }}</b></td>
                <td width="90px" style="background-color: #cccccc; text-align:center"><b>{{ $moneda->symbol." ". $suma_subtotal }}</b></td>
            </tr>
            
        </tbody>

    </table>

    <p>
        <b>Monto a pagar: {{$moneda->symbol." ".  $venta->precio_total }}</b><br><br>
        <b>Son: </b>{{ $literal }}
    </p>

    <p style="text-align: center">
        --------------------------------------------------------------------------------------------------------------------------------------------
        <br><b>Gracias por su compra</b>
    </p>

</body>
</html>
