<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title></title>
    <style>
        div.content{
            width: 720px;
            height: 990px;
            border: 2px solid;
            text-align: center;
        }
        div.result{
            border: 1px solid;
            border-radius: 3px;
        }
        div.center-text{
            text-align: center;
        }
        div.footer{
            text-align: right;
            font-size: small;
            font-style: italic;
        }
        td.text{
            text-align: right;
        }
        th.text-center{
            text-align: center;
        }
        td.text-center{
            text-align: center;
        }
        table.show{
            width: 720px;
        }
        hr{
            width: 680px;
        }
    </style>
</head>
<body>
    <div class="content">
        <table class="show">
            <tbody>
            <tr>
                <td rowspan="3" style="text-align: center;">
                    <img src="{{ $_SERVER["DOCUMENT_ROOT"].'/img/logo_unid.png' }}" width="170" height="100">
                </td>
                <td colspan="4" class="text-center">Universidad Interamericana para el Desarrollo</td>
            </tr>
            <tr>
                <td class="text-center"><b>Reporte :</b></td>
                <td colspan="3" class="text-center">{{ $config['tipo']}}</td>
            </tr>
            <tr>
                <td class="text-center"><b>Desde :</b></td>
                <td>{{ $config['fecha_inicial'] }}</td>
                <td class="text-center"><b>Hasta :</b></td>
                <td>{{ $config['fecha_final'] }}</td>
            </tr>
            </tbody>
        </table>
        @foreach ($docentes as $docente)
            <hr>
            <div class="center-text">
                <b>ID:</b> {{ $docente->id_banner }} &nbsp;&nbsp; <b>Docente:</b> {{ $docente->nombre }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
            </div>
            <hr>
            <br>
            <table class="show">
                <thead>
                    <tr>
                        <th class="text-center">Fecha y hora</th>
                        <th class="text-center">CRN</th>
                        <th class="text-center">Materia</th>
                        <th class="text-center">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros[$docente->id_banner] as $registro)
                    <tr>
                        <td class="text-center">{{ $registro->fecha_hora_reg }}</td>
                        <td class="text-center">{{ $registro->crn }}</td>
                        <td class="text-center">{{ $registro->crn_descripcion }}</td>
                        <td class="text-center">{{ $registro->tipo_registro }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
        @endforeach
    </div>
    <div class="footer">
        Sistema de Control de Asistencia Docente
    </div>
</body>
</html>

