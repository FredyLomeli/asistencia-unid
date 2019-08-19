@extends('layout')

@section('title',"Listado de Horarios")

@section('asunto',"Horario Docente")

@section('descripcion', "Listado de horarios")

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li class="active">Horario Docente</li>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form method="GET" action="{{ route('horarioDocente.index') }}">
                        <div class="form-group col-xs-12">
                            <a class="btn btn-default col-xs-2" href="{{ route('horarioDocente.create') }}"><li class="fa fa-file-o"></li> Nuevo horario</a>
                            <div class="col-xs-3 col-md-2">
                                <select class="form-control" id="registros" name="registros" >
                                    <option value="10" {{ $registros == 10 ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ $registros == 15 ? 'selected' : '' }}>15</option>
                                    <option value="20" {{ $registros == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ $registros == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ $registros == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-7">
                                <input type="text" name="filtro" id="filtro" class="form-control pull-right"
                                placeholder="Busqueda" value="{{ $filtro }}">
                            </div>
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            @foreach($cabeceras as $cabecera)
                                @if ($cabecera != "No")
                                <th style="text-align: center">{{ $cabecera }}</th>
                                @endif
                            @endforeach
                            <th colspan="3" style="text-align: center">Acciones</th>
                        </tr>
                        @foreach ($horarioMateriaDocente as $horario)
                        <tr>
                            @foreach($campos as $campo)
                                @if($campo === "dia")
                                <td style="text-align: center">@switch($horario[$campo])
                                    @case(0) {{ "Domingo" }} @break
                                    @case(1) {{ "Lunes" }} @break
                                    @case(2) {{ "Martes" }} @break
                                    @case(3) {{ "Miercoles" }} @break
                                    @case(4) {{ "Jueves" }} @break
                                    @case(5) {{ "Viernes" }} @break
                                    @case(6) {{ "Sabado" }} @break
                                    @default @break
                                @endswitch</td>
                                @elseif($campo === "comentario")
                                <td style="text-align: center">{{ Str::limit($horario[$campo],30) }}</td>
                                @elseif ($campo != "id")
                                <td style="text-align: center">{{ $horario[$campo] }}</td>
                                @endif
                            @endforeach
                            <td style="text-align: center"><a class="btn btn-default" href="{{ route('horarioDocente.show', $horario) }}"><i class="fa fa-eye"></i></a></td>
                            <td style="text-align: center"><a class="btn btn-default" href="{{ route('horarioDocente.edit', $horario) }}"><i class="fa fa-pencil"></i></a></td>
                            <td style="text-align: center">
                                <a class="btn btn-default" data-toggle="modal" data-target="#myModal"
                                @click='eliminarDocente( {{ $horario->id }}, "{{ $horario->crn }} {{ $horario->descripcion }}","{{ $horario->id_docente }}" )'>
                                <li class="fa fa-trash"></li></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {!! $horarioMateriaDocente->links('horarioDocente.pagination',['filtro' => $filtro, 'registros' => $registros]) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
<div class="modal modal-danger fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header -danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Eliminar horario</h4>
            </div>
            <div class="modal-body" >
                Esta por eliminar el horario con los siguientes datos : <br>
                CRN : @{{ crn }}, ID Docente: @{{ idBanner }} <br>
                Realmente, ¿Deseas aceptar esta accion?
            </div>
            <div class="modal-footer">
                <form role="form" class="form-horizontal" method="post" :action="crearUrl()">
                    {{method_field('DELETE')}} {{csrf_field()}}
                    <input type="hidden" id="id" name="id" v-model="id">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptsheet')
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script>
        var vm = new Vue({
            el: '#frexal',
            data: {
                id: 0,
                crn: "",
                idBanner: "",
            },
            methods:{
                eliminarDocente: function (sId,sCrn,sIdBanner) {
                    if(sId>0){
                        this.id = sId;
                        this.crn = sCrn;
                        this.idBanner = sIdBanner;
                        crearUrl();
                    }
                },
                crearUrl: function(){
                    return "http://localhost:8000/horario/docente/" + this.id + "/delete"
                }
            }
        });
    </script>
@endsection
