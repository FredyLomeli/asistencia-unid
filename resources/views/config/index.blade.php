@extends('layout')

@section('title',"Listado de Configuraciones")

@section('asunto',"Configuraciones")

@section('descripcion', "Listado de Configuraciones")

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li class="active">Configuraciones</li>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form method="GET" action="{{ route('config.index') }}">
                        <div class="form-group col-xs-12">
                            <a class="btn btn-default col-xs-2" href="{{ route('config.create') }}"><li class="fa fa-file-o"></li> Nueva configuracion</a>
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
                            <th style="text-align: center">ID</th>
                            <th style="text-align: center">Nombre</th>
                            <th style="text-align: center">Datos</th>
                            <th style="text-align: center">Tipo</th>
                            <th colspan="3" style="text-align: center">Acciones</th>
                        </tr>
                        @foreach ($configuraciones as $configuracion)
                        <tr>
                            <td style="text-align: center">{{ $configuracion->id }}</td>
                            <td style="text-align: center">{{ $configuracion->nombre }}</td>
                            <td style="text-align: center">{{ Str::limit($configuracion->datos,30) }}</td>
                            <td style="text-align: center">
                                @switch($configuracion->tipo)
                                    @case(0) {{ "BloqueoDocentes" }} @break
                                    @case(1) {{ "BloqueoCRN" }} @break
                                    @case(2) {{ "BloqueoContraseña" }} @break
                                    @case(3) {{ "Contraseña" }} @break
                                    @case(4) {{ "Calendario" }} @break
                                    @case(5) {{ "Asueto" }} @break
                                    @case(6) {{ "NombredeCampos" }} @break
                                    @case(7) {{ "CamposdeTabla" }} @break
                                    @case(8) {{ "TamañodeCampos" }} @break
                                    @case(9) {{ "NombredeCamposFiltro" }} @break
                                    @case(10) {{ "CamposdeFiltro" }} @break
                                    @case(11) {{ "Limitederegistros" }} @break
                                    @default @break
                                @endswitch
                            </td>
                            <td style="text-align: center"><a class="btn btn-default"
                                href="{{ route('config.show', $configuracion) }}"><i class="fa fa-eye"></i></a></td>
                            <td style="text-align: center"><a class="btn btn-default"
                                href="{{ route('config.edit', $configuracion) }}"><i class="fa fa-pencil"></i></a></td>
                            <td style="text-align: center">
                                <a class="btn btn-default" data-toggle="modal" data-target="#myModal"
                                @click='eliminarConfiguracion( {{ $configuracion->id }}, "{{ $configuracion->nombre }}" )'>
                                <li class="fa fa-trash"></li></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {!! $configuraciones->links('config.pagination',['filtro' => $filtro, 'registros' => $registros]) !!}
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
                <h4 class="modal-title" id="myModalLabel">Eliminar Configuracion</h4>
            </div>
            <div class="modal-body" >
                Esta por eliminar la configuracion con los siguientes datos : <br>
                ID : @{{ id }}, Nombre: @{{ nombreConfig }} <br>
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
                nombreConfig: "",
            },
            methods:{
                eliminarConfiguracion: function (sId,sNombreConfig) {
                    if(sId>0){
                        this.id = sId;
                        this.nombreConfig = sNombreConfig;
                        crearUrl();
                    }
                },
                crearUrl: function(){
                    return "http://localhost:8000/config/" + this.id + "/delete"
                }
            }
        });
    </script>
@endsection
