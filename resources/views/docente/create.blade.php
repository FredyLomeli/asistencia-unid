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
            <h3 class="box-title">Horizontal Form</h3>
        </div>
        <form class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label for="id_banner" class="col-lg-2 control-label">ID:</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" id="id_banner" name="id_banner" placeholder="ID DOCENTE">
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-lg-2 control-label">Nombre(s)</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="JOSE">
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_paterno" class="col-lg-2 control-label">Apellido Paterno</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="PEREZ">
                </div>
            </div>
            <div class="form-group">
                <label for="apellido_materno" class="col-lg-2 control-label">Apellido Materno</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="LOPEZ">
                </div>
            </div>
            <div class="form-group">
                <label for="estado" class="col-lg-2 control-label">Estado</label>
                <div class="col-lg-5">
                    <select class="form-control" disabled>
                        <option>option 1</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="fecha_registro" class="col-lg-2 control-label">Fecha registro</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" >
                </div>
            </div>
            <div class="form-group">
                <label for="comentario" class="col-lg-2 control-label">Comentarios</label>
                <div class="col-lg-5">
                    <textarea type="text" class="form-control" id="comentario" name="comentario"></textarea>
                </div>
            </div>
        
        <div class="box-footer">
            <div class="form-group col-lg-8">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Sign in</button>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection
