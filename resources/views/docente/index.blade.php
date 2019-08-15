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
                    <a class="btn btn-default" href="{{ route('docente.create') }}"><li class="fa fa-file-o"></li> Nuevo docente</a>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" >
                            <label for="estatus" class="control-label">Estado</label>
                            <select class="form-control" id="estatus" name="estatus" >
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            <input type="text" name="table_search" class="form-control pull-right"
                                placeholder="Busqueda">
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
                                <th style="text-align: center">{{ $cabecera }}</th>
                                @endif
                            @endforeach
                            <th colspan="3" style="text-align: center">Acciones</th>
                        </tr>
                        @foreach ($docentes as $docente)
                        <tr>
                            @foreach($campos as $campo)
                                @if($campo === "estatus")
                                <td style="text-align: center">{{ $docente[$campo] === 1 ? 'Activo' : 'Inactivo'}}</td>
                                @elseif ($campo != "id")
                                <td style="text-align: center">{{ $docente[$campo] }}</td>
                                @endif
                            @endforeach
                            <td style="text-align: center"><a class="btn btn-default" href="{{ route('docente.show', $docente) }}"><i class="fa fa-eye"></i> Ver Detalles</a></td>
                            <td style="text-align: center"><a class="btn btn-default" href="{{ route('docente.edit', $docente) }}"><i class="fa fa-pencil"></i> Editar</a></td>
                            <td style="text-align: center">
                                <a class="btn btn-default" data-toggle="modal" data-target="#myModal" 
                                @click="eliminarDocente( {{ $docente->id }}, '{{ $docente->id_banner }}', '{{ $docente->nombre }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}' )">
                                <li class="fa fa-trash"></li> Eliminar</a></td>
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

@section('modals')
<div class="modal modal-danger fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header -danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Eliminar docente</h4>
            </div>
            <div class="modal-body" >
                Esta por eliminar el docente con los siguientes datos : <br>
                ID : @{{ idDocente }}, Nombre: @{{ nombreDocente }} <br>
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
                idDocente: "",
                nombreDocente: "",
            },
            methods:{
                eliminarDocente: function (sId,sIdDocente,sNombreDocente) {
                    if(sId>0){
                        this.id = sId;
                        this.idDocente = sIdDocente;
                        this.nombreDocente = sNombreDocente;
                        crearUrl();
                    }
                },
                crearUrl: function(){
                    return "http://localhost:8000/docentes/" + this.id + "/delete"
                }
            }
        });
    </script>
@endsection
