@extends('layout')

@section('title',"Control de asistencia")

@section('asunto')
Docente ID : {{ $docente->id_banner }}
@endsection

@section('descripcion')
Vista detalle
@endsection

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li><a href="{{ route('docente.index') }}"> Docentes</a></li>
<li class="active">Ver detalle</li>
@endsection

@section('contenido')
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-xs-9 col-lg-7">
                    <a class="btn btn-default pull-right" href="{{ route('docente.index') }}"><i class="fa fa-list"></i> Regresar</a>
                </div>
                <div class="col-xs-3 col-lg-1">
                    <a class="btn btn-default pull-right" href="{{ route('docente.edit', $docente) }}"><i class="fa fa-pencil"></i> Editar</a>
                </div>
            </div>
        </div>
        <form class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label for="id_banner" class="col-lg-3 control-label">ID:</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" id="id_banner" name="id_banner" 
                    placeholder="ID DOCENTE" value="{{ $docente->id_banner }}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-lg-3 control-label">Nombre(s)</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                    placeholder="JOSE" value="{{ $docente->nombre }}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_paterno" class="col-lg-3 control-label">Apellido Paterno</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" 
                    placeholder="PEREZ" value="{{ $docente->apellido_paterno }}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_materno" class="col-lg-3 control-label">Apellido Materno</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" 
                    placeholder="LOPEZ" value="{{ $docente->apellido_materno }}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="estatus" class="col-lg-3 control-label">Estado</label>
                <div class="col-lg-5">
                    <select class="form-control" id="estatus" name="estatus"  disabled>
                        <option>{{ $docente->estatus === 1 ? 'Activo' : 'Inactivo' }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="fecha_registro" class="col-lg-3 control-label">Fecha registro</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" 
                    value="{{ $docente->fecha_registro }}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="comentario" class="col-lg-3 control-label">Comentarios</label>
                <div class="col-lg-5">
                    <textarea type="text" class="form-control" id="comentario" 
                    name="comentario" disabled>{{ $docente->comentario }}</textarea>
                </div>
            </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-xs-9 col-lg-7">
                    <a class="btn btn-default pull-right" href="{{ route('docente.index') }}"><i class="fa fa-list"></i> Regresar</a>
                </div>
                <div class="col-xs-3 col-lg-1">
                    <a class="btn btn-default pull-right" href="{{ route('docente.edit', $docente) }}"><i class="fa fa-pencil"></i> Editar</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
