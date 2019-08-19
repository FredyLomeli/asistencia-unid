@extends('layout')

@section('title',"Control de asistencia")

@section('asunto')
Docente ID : {{ $docente->id_banner }}
@endsection

@section('descripcion')
Edición de registro
@endsection

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li><a href="{{ route('docente.index') }}"> Docentes</a></li>
<li class="active">Edicion</li>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <form class="form-horizontal" method="post" action="{{ route('docente.update', $docente) }}">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-xs-6 col-lg-6">
                            <a class="btn btn-default pull-right" href="{{ route('docente.index') }}"><i
                                    class="fa fa-list"></i> Regresar</a>
                        </div>
                        <div class="col-xs-3 col-lg-1">
                            <a class="btn btn-default pull-right" href="{{ route('docente.show', $docente) }}"><i
                                    class="fa fa-times"></i> Cancelar</a>
                        </div>
                        <div class="col-xs-3 col-lg-1">
                            <button type="submit" class="btn btn-default pull-right"><i class="fa fa-save"></i>
                                Guardar</button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group {{ $errors->has('id_banner') ? ' has-error' : '' }}">
                        <label for="id_banner" class="col-lg-3 control-label">
                            @if ($errors->has('id_banner'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            ID:</label>
                        <div class="col-lg-3">
                            <input type="text" minlength="8" maxlength="10" class="form-control" id="id_banner"
                                name="id_banner" placeholder="ID DOCENTE"
                                value="{{ old('id_banner', $docente->id_banner) }}">
                            @if ($errors->has('id_banner'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_banner') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-lg-3 control-label">
                            @if ($errors->has('nombre'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Nombre(s)</label>
                        <div class="col-lg-5">
                            <input type="text" maxlength="100" class="form-control" id="nombre" name="nombre"
                                placeholder="JOSE" value="{{ old('nombre', $docente->nombre) }}">
                            @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('apellido_paterno') ? ' has-error' : '' }}">
                        <label for="apellido_paterno" class="col-lg-3 control-label">
                            @if ($errors->has('apellido_paterno'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Apellido Paterno</label>
                        <div class="col-lg-5">
                            <input type="text" maxlength="100" class="form-control" id="apellido_paterno"
                                name="apellido_paterno" placeholder="PEREZ"
                                value="{{ old('apellido_paterno', $docente->apellido_paterno) }}">
                            @if ($errors->has('apellido_paterno'))
                            <span class="help-block">
                                <strong>{{ $errors->first('apellido_paterno') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('apellido_materno') ? ' has-error' : '' }}">
                        <label for="apellido_materno" class="col-lg-3 control-label">
                            @if ($errors->has('apellido_materno'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Apellido Materno</label>
                        <div class="col-lg-5">
                            <input type="text" maxlength="100" class="form-control" id="apellido_materno"
                                name="apellido_materno" placeholder="LOPEZ"
                                value="{{ old('apellido_materno', $docente->apellido_materno) }}">
                            @if ($errors->has('apellido_materno'))
                            <span class="help-block">
                                <strong>{{ $errors->first('apellido_materno') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('estatus') ? ' has-error' : '' }}">
                        <label for="estatus" class="col-lg-3 control-label">
                            @if ($errors->has('estatus'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Estado</label>
                        <div class="col-lg-5">
                            <select class="form-control" id="estatus" name="estatus">
                                <option value="1" {{ old('estatus', $docente->estatus) == 1 ? 'selected' : '' }}>Activo
                                </option>
                                <option value="0" {{ old('estatus', $docente->estatus) == 0 ? 'selected' : '' }}>
                                    Inactivo</option>
                            </select>
                            @if ($errors->has('estatus'))
                            <span class="help-block">
                                <strong>{{ $errors->first('estatus') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="col-lg-3 control-label">Fecha registro</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="fecha" value="{{ $docente->fecha_registro }}"
                                disabled>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('comentario') ? ' has-error' : '' }}">
                        <label for="comentario" class="col-lg-3 control-label">
                            @if ($errors->has('comentario'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Comentarios</label>
                        <div class="col-lg-5">
                            <textarea type="text" maxlength="500" class="form-control" id="comentario"
                                name="comentario">{{ old('comentario', $docente->comentario) }}</textarea>
                            @if ($errors->has('comentario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comentario') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="row">
                                <div class="col-xs-6 col-lg-6">
                                    <a class="btn btn-default pull-right" href="{{ route('docente.index') }}"><i
                                            class="fa fa-list"></i> Regresar</a>
                                </div>
                                <div class="col-xs-3 col-lg-1">
                                    <a class="btn btn-default pull-right"
                                        href="{{ route('docente.show', $docente) }}"><i class="fa fa-times"></i>
                                        Cancelar</a>
                                </div>
                                <div class="col-xs-3 col-lg-1">
                                    <button type="submit" class="btn btn-default pull-right"><i class="fa fa-save"></i>
                                        Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{method_field('PUT')}} {{csrf_field()}}
            </form>
        </div>
    </div>
</div>
@endsection
