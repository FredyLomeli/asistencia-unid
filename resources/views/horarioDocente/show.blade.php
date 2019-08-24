@extends('layout')

@section('title',"Control de asistencia")

@section('asunto', "Horario")

@section('descripcion', "Ver detalles")

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li><a href="{{ route('horarioDocente.index') }}"> Horario Docente</a></li>
<li class="active">Ver Detalle</li>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-xs-9 col-lg-7">
                            <a class="btn btn-default pull-right" href="{{ route('horarioDocente.index') }}"><i
                                    class="fa fa-list"></i> Regresar</a>
                        </div>
                        <div class="col-xs-3 col-lg-1">
                            <a class="btn btn-default pull-right" href="{{ route('horarioDocente.edit', $horarioMateriaDocente) }}"><i
                                    class="fa fa-pencil"></i> Editar</a>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="id_docente" class="col-lg-3 control-label">ID Docente:</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" value="{{ $horarioMateriaDocente->id_docente }}" readonly>
                            </div>
                            <div class="col-lg-1">
                                <a class="btn btn-default" disabled><li class="fa fa-search"></li></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crn" class="col-lg-3 control-label">CRN:</label>
                            <div class="col-lg-3">
                                <input type="text"class="form-control" value="{{ $horarioMateriaDocente->crn }}" readonly>
                            </div>
                            <div class="col-lg-1">
                                <a class="btn btn-default" disabled><li class="fa fa-search"></li></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-lg-3 control-label">Descripcion:</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" value="{{ $horarioMateriaDocente->descripcion }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="calendario" class="col-lg-3 control-label">Calendario:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" value="{{ $horarioMateriaDocente->calendario }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fecha_vig_ini" class="col-lg-3 control-label">Fecha Inicio:</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control" value="{{ $horarioMateriaDocente->fecha_vig_ini }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fecha_vig_fin" class="col-lg-3 control-label">Fecha Fin:</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control" value="{{ $horarioMateriaDocente->fecha_vig_fin }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dia" class="col-lg-3 control-label">Dia:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" value="@switch($horarioMateriaDocente->dia)
                                @case(0) {{ "Domingo" }} @break
                                @case(1) {{ "Lunes" }} @break
                                @case(2) {{ "Martes" }} @break
                                @case(3) {{ "Miercoles" }} @break
                                @case(4) {{ "Jueves" }} @break
                                @case(5) {{ "Viernes" }} @break
                                @case(6) {{ "Sabado" }} @break
                                @default @break
                            @endswitch" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hora_ini" class="col-lg-3 control-label">Hora de entrada:</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input type="text" class="form-control"  value="{{ $horarioMateriaDocente->hora_ini }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hora_fin" class="col-lg-3 control-label">Hora de Salida:</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input type="text" class="form-control" value="{{ $horarioMateriaDocente->hora_fin }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="grupo" class="col-lg-3 control-label">Grupo:</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" value="{{ $horarioMateriaDocente->grupo }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comentario" class="col-lg-3 control-label">Comentario:</label>
                            <div class="col-lg-3">
                                <textarea type="text" class="form-control" readonly>{{ $horarioMateriaDocente->comentario }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-9 col-lg-7">
                            <a class="btn btn-default pull-right" href="{{ route('horarioDocente.index') }}"><i
                                    class="fa fa-list"></i> Regresar</a>
                        </div>
                        <div class="col-xs-3 col-lg-1">
                            <a class="btn btn-default pull-right" href="{{ route('horarioDocente.edit', $horarioMateriaDocente) }}"><i
                                    class="fa fa-pencil"></i> Editar</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
