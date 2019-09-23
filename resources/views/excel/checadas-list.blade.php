<!DOCTYPE html>
<html>
<head>
    <style>
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
    </style>
</head>
<body>
    <table class="show">
        <tbody>
        <tr>
            <td rowspan="3" style="text-align: center;">
                <img src="{{ $_SERVER["DOCUMENT_ROOT"].'/img/logo_unid.png' }}" width="170" height="80">
            </td>
            <td colspan="4" class="text-center">Universidad Interamericana para el Desarrollo</td>
        </tr>
        <tr>
            <td class="text-center"><b>Reporte :</b></td>
            <td colspan="3" class="text-center">{{ $config['tipo'] }}</td>
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
    <table class="show">
        <td class="text-center" colspan="5">
            <b>ID:</b> {{ $docente->id_banner }} &nbsp;&nbsp; <b>Docente:</b> {{ $docente->nombre }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}
        </td>
    </table>
        <table class="show">
            <thead>
                <tr>
                    <th class="text-center">Fecha y hora</th>
                    <th class="text-center">CRN</th>
                    <th class="text-center">Dia</th>
                    <th class="text-center">Materia</th>
                    <th class="text-center">Tipo</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($registros[$docente->id_banner]))
                @foreach ($registros[$docente->id_banner] as $registro)
                <tr>
                    <td class="text-center">{{ $registro->fecha_hora_reg }}</td>
                    <td class="text-center">{{ $registro->crn }}</td>
                    <td class="text-center">@switch($registro->dia)
                        @case(0)Domingo @break
                        @case(1)Lunes @break
                        @case(2)Martes @break
                        @case(3)Miercoles @break
                        @case(4)Jueves @break
                        @case(5)Viernes @break
                        @case(6)Sabado @break
                        @default
                    @endswitch</td>
                    <td class="text-center">{{ $registro->crn_descripcion }}</td>
                    <td class="text-center">{{ $registro->tipo_registro }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">No se encontraron registros para este docente.</td>
                </tr>
                @endif
            </tbody>
        </table>
        <br>
    @endforeach
</body>
</html>

