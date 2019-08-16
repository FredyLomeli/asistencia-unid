@extends('layout')

@section('title',"Control de asistencia")

@section('asunto',"Materia CRN : $crn->crn")

@section('descripcion', "Vista detalle")

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li><a href="{{ route('crn.index') }}"> Materia</a></li>
<li class="active">Ver detalle</li>
@endsection

@section('contenido')
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-xs-9 col-lg-7">
                    <a class="btn btn-default pull-right" href="{{ route('crn.index') }}"><i class="fa fa-list"></i> Regresar</a>
                </div>
                <div class="col-xs-3 col-lg-1">
                    <a class="btn btn-default pull-right" href="{{ route('crn.edit', $crn) }}"><i class="fa fa-pencil"></i> Editar</a>
                </div>
            </div>
        </div>
        <form class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label for="crn" class="col-lg-3 control-label">CRN:</label>
                <div class="col-lg-3">
                    <input type="text" minlength="8" maxlength="10" class="form-control" id="crn" name="crn" 
                    placeholder="63454" value="{{ $crn->crn }}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-lg-3 control-label">Nombre</label>
                <div class="col-lg-5">
                    <input type="text" maxlength="100" class="form-control" id="nombre" name="nombre" 
                    placeholder="Tecnologia Educativa" value="{{ $crn->nombre }}" disabled>
                </div>
            </div>
            <div class="form-group ">
                <label for="estado" class="col-lg-3 control-label">Estado</label>
                <div class="col-lg-5">
                    <select class="form-control" id="estado" name="estado" disabled>
                        <option value="1" {{ $crn->estado == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $crn->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-xs-9 col-lg-7">
                    <a class="btn btn-default pull-right" href="{{ route('crn.index') }}"><i class="fa fa-list"></i> Regresar</a>
                </div>
                <div class="col-xs-3 col-lg-1">
                    <a class="btn btn-default pull-right" href="{{ route('crn.edit', $crn) }}"><i class="fa fa-pencil"></i> Editar</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
