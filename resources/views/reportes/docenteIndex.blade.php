@extends('layout')

@section('title',"Reporte por docente")

@section('asunto',"Reportes")

@section('descripcion', "Generacion de reportes por docente")

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li class="active">Reportes</li>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <form class="form-horizontal" method="post" action="">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="form-group col-lg-6 {{ $errors->has('crn') ? ' has-error' : '' }}">
                            <label for="crn" class="col-lg-3 control-label">
                                @if ($errors->has('crn'))
                                <i class="fa fa-times-circle-o"></i>
                                @endif
                                CRN:</label>
                            <div class="col-lg-9">
                                <input type="text" minlength="5" maxlength="8" class="form-control" id="crn" name="crn"
                                    placeholder="63454" value="{{ old('crn') }}">
                                @if ($errors->has('crn'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('crn') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-lg-6 {{ $errors->has('crn') ? ' has-error' : '' }}">
                            <label for="crn" class="col-lg-3 control-label">
                                @if ($errors->has('crn'))
                                <i class="fa fa-times-circle-o"></i>
                                @endif
                                CRN:</label>
                            <div class="col-lg-9">
                                <input type="text" minlength="5" maxlength="8" class="form-control" id="crn" name="crn"
                                    placeholder="63454" value="{{ old('crn') }}">
                                @if ($errors->has('crn'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('crn') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group {{ $errors->has('crn') ? ' has-error' : '' }}">
                        <label for="crn" class="col-lg-3 control-label">
                            @if ($errors->has('crn'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            CRN:</label>
                        <div class="col-lg-3">
                            <input type="text" minlength="5" maxlength="8" class="form-control" id="crn" name="crn"
                                placeholder="63454" value="{{ old('crn') }}">
                            @if ($errors->has('crn'))
                            <span class="help-block">
                                <strong>{{ $errors->first('crn') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-lg-3 control-label">
                            @if ($errors->has('nombre'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Nombre</label>
                        <div class="col-lg-5">
                            <input type="text" maxlength="250" class="form-control" id="nombre" name="nombre"
                                placeholder="Tecnologia Educativa" value="{{ old('nombre')}}">
                            @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
                        <label for="estado" class="col-lg-3 control-label">
                            @if ($errors->has('estado'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Estado</label>
                        <div class="col-lg-5">
                            <select class="form-control" id="estado" name="estado">
                                <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>Activo
                                </option>
                                <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>Inactivo
                                </option>
                            </select>
                            @if ($errors->has('estado'))
                            <span class="help-block">
                                <strong>{{ $errors->first('estado') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
                {{csrf_field()}}
            </form>
        </div>
    </div>
</div>
@endsection
