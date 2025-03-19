<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* Encabezado */
        .header{
            background: #f0f0f0;
        }

        /* Pie de página */
        .footer{
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: #f0f0f0;
            text-align: center;
            line-height: 30px;
            font-size: 12px;
            border-top: 1px solid #000;
        }

        /* Estilo del contenido */
        .content{
            margin: 20px 20px 50px 20px; /* Espacio para encabezado y pie */
        }

        .page-number:before{
            content: 'Página' counter(page);
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

</head>
<body>
    <div class="header">
        <table border="0" style="font-size: 8pt">
    
            <tr>
                <td style="text-align: center">
                    {{ $empresa->nombre_empresa }} <br>
                    Tel: {{ $empresa->telefono }} <br>
                    {{ $empresa->correo }} <br>
                    {{ $empresa->direccion }} <br>
                </td>
    
                <td style="text-align: center" width="500px">
                    <h1>Sistema de categorias</h1>
                </td>
                <td style="text-align: center">
                    <img src="{{ public_path('storage/'.$empresa->logo) }}" width="100px" alt="logo">
                </td>
            </tr>
    
        </table>
    </div>

    <div class="content">
            <h2>Reporte de ventas</h2>   
        <table border="0" class=" table table-bordered" cellpadding="5">
            <tr>
                <td width="30px" style="background-color: #cccccc; text-align:center"><b>Nro</b></td>
                <td width="100px" style="background-color: #cccccc; text-align:center"><b>Fecha de la venta</b></td>
                <td width="50px" style="background-color: #cccccc; text-align:center"><b>Precio Total</b></td>
                <td width="50px" style="background-color: #cccccc; text-align:center"><b>Cliente</b></td>
                <td width="50px" style="background-color: #cccccc; text-align:center"><b>Código del cliente</b></td>
                <td width="160px" style="background-color: #cccccc; text-align:center"><b>Fecha y hora de registro</b></td>
                
            <tbody>
                    @php
                        $contador_ventas = 1;
                        $suma_total = 0;
                    @endphp  
                @foreach ($ventas as $venta )
                @php
                    $suma_total += $venta->precio_total;
                @endphp
                    <tr>
                        <td style="text-align: center">{{ $contador_ventas++ }}</td>
                        <td style="text-align: center">{{ $venta->fecha_venta }}</td>
                        <td style="text-align: center">{{ $venta->precio_total }}</td>
                        <td style="text-align: center">{{ $venta->cliente->nombre_cliente }}</td>
                        <td style="text-align: center">{{ $venta->cliente->codigo }}</td>
                        <td style="text-align: center">{{ $venta->created_at }}</td>
                    </tr>
                @endforeach
    
            </tbody>
    
        </table>

        <p><b>Total de ventas: </b> {{ $suma_total }} </p>

    </div>

    <div class="footer">
        <small class="page-number"></small>
    </div>

</body>
</html>