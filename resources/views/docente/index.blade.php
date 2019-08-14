@extends('layout')

@section('title',"Listado de docentes")

@section('asunto')
Docentes
@endsection

@section('descripcion')
Listado de docentes
@endsection

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li class="active">Docentes</li>
@endsection


@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Responsive Hover Table</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right"
                                placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            @foreach($cabeceras as $cabecera)
                                @if ($cabecera != "No")
                                <th>{{ $cabecera }}</th>
                                @endif
                            @endforeach
                            <th colspan="3">Herramientas</th>
                        </tr>
                        @foreach ($docentes as $docente)
                        <tr>
                            @foreach($campos as $campo)
                                @if ($campo != "id")
                                <td>{{ $docente[$campo] }}</td>
                                @endif
                            @endforeach
                            <td><a href="{{ route('docente.show', $docente) }}"><i class="fa fa-eye"></i></a></td>
                            <td><a href="{{ route('docente.edit', $docente) }}"><i class="fa fa-pencil"></i></a></td>
                            <td>
                                <form action="{{ route('docente.destroy', $docente) }}" method="POST">
                                        {!! method_field('DELETE') !!}
                                        {!! csrf_field() !!}
                                        <button type="submit" class="btn btn-link"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                        {{ $docentes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
