@extends('layout')

@section('title',"Listado de Materias")

@section('asunto',"Materias")

@section('descripcion', "Listado de Materias")

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li class="active">Materias</li>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form method="GET" action="{{ route('crn.index') }}">
                        <div class="form-group col-xs-12">
                            <a class="btn btn-default col-xs-2" href="{{ route('crn.create') }}"><li class="fa fa-file-o"></li> Nuevo docente</a>
                            <div class="col-xs-3 col-md-1">
                                <select class="form-control" id="registros" name="registros" >
                                    <option value="10" {{ $registros == 10 ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ $registros == 15 ? 'selected' : '' }}>15</option>
                                    <option value="20" {{ $registros == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ $registros == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ $registros == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-8">
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
                        @foreach ($crns as $crn)
                        <tr>
                            @foreach($campos as $campo)
                                @if($campo === "estado")
                                <td style="text-align: center">{{ $crn[$campo] === 1 ? 'Activo' : 'Inactivo'}}</td>
                                @elseif ($campo != "id")
                                <td style="text-align: center">{{ $crn[$campo] }}</td>
                                @endif
                            @endforeach
                            <td style="text-align: center"><a class="btn btn-default" href="{{ route('crn.show', $crn) }}"><i class="fa fa-eye"></i> Ver Detalles</a></td>
                            <td style="text-align: center"><a class="btn btn-default" href="{{ route('crn.edit', $crn) }}"><i class="fa fa-pencil"></i> Editar</a></td>
                            <td style="text-align: center">
                                <a class="btn btn-default" data-toggle="modal" data-target="#myModal" 
                                @click='eliminarMateria( {{ $crn->id }}, "{{ $crn->crn }}","{{ $crn->nombre }}" )'>
                                <li class="fa fa-trash"></li> Eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {!! $crns->links('crn.pagination',['filtro' => $filtro, 'registros' => $registros]) !!}
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
                <h4 class="modal-title" id="myModalLabel">Eliminar docente</h4>
            </div>
            <div class="modal-body" >
                Esta por eliminar la Materia con los siguientes datos : <br>
                CRN : @{{ crn }}, Nombre: @{{ nombreMateria }} <br>
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
                nombreMateria: "",
            },
            methods:{
                eliminarMateria: function (sId,sCrn,sNombreMateria) {
                    if(sId>0){
                        this.id = sId;
                        this.crn = sCrn;
                        this.nombreMateria = sNombreMateria;
                        crearUrl();
                    }
                },
                crearUrl: function(){
                    return "http://localhost:8000/materias/" + this.id + "/delete"
                }
            }
        });
    </script>
@endsection
