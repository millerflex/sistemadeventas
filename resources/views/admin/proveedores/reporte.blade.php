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
    
                <td style="text-align: center" width="700px">
                    <h1>Sistema de categorias</h1>
                </td>
                <td style="text-align: center">
                    <img src="{{ public_path('storage/'.$empresa->logo) }}" width="100px" alt="logo">
                </td>
            </tr>
    
        </table>
    </div>

    <div class="content">
            <h2>Reporte de proveedores</h2>   
        <table border="0" class=" table table-bordered" cellpadding="5">
            <tr>
                <td width="30px" style="background-color: #cccccc; text-align:center"><b>Nro</b></td>
                <td width="30px" style="background-color: #cccccc; text-align:center"><b>Empresa</b></td>
                <td width="150px" style="background-color: #cccccc; text-align:center"><b>Dirección</b></td>
                <td width="50px" style="background-color: #cccccc; text-align:center"><b>Teléfono</b></td>
                <td width="95px" style="background-color: #cccccc; text-align:center"><b>Email</b></td>
                <td width="95px" style="background-color: #cccccc; text-align:center"><b>Nombre</b></td>
                <td width="80px" style="background-color: #cccccc; text-align:center"><b>Celular</b></td>
                <td width="180px" style="background-color: #cccccc; text-align:center"><b>Fecha y hora de registro</b></td>

            <tbody>
                    @php
                        $contador_proveedores = 1;
                    @endphp  
                @foreach ($proveedores as $proveedor )
                    <tr>
                        <td style="text-align: center">{{ $contador_proveedores++ }}</td>
                        <td style="text-align: center">{{ $proveedor->empresa }}</td>
                        <td style="text-align: center">{{ $proveedor->direccion }}</td>
                        <td style="text-align: center">{{ $proveedor->telefono }}</td>
                        <td style="text-align: center">{{ $proveedor->email }}</td>
                        <td style="text-align: center">{{ $proveedor->nombre }}</td>
                        <td style="text-align: center">{{ $proveedor->celular }}</td>
                        <td style="text-align: center">{{ $proveedor->created_at }}</td>
                    </tr>
                @endforeach
    
            </tbody>
    
        </table>

    </div>

    <div class="footer">
        <small class="page-number"></small>
    </div>

</body>
</html>