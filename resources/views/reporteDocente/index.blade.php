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
            <form class="form-horizontal" method="post" action="{{ route('reporteDocente.generar') }}">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="form-group col-lg-6 {{ $errors->has('tipo') ? ' has-error' : '' }}">
                            <label for="tipo" class="col-lg-3 control-label">
                                @if ($errors->has('tipo'))
                                <i class="fa fa-times-circle-o"></i>
                                @endif
                                Tipo de Reporte
                            </label>
                            <div class="col-lg-9">
                                <select class="form-control" id="tipo" name="tipo">
                                    <option value="0" {{ old('tipo') == 0 ? 'selected' : '' }}>Checadas</option>
                                    <option value="1" {{ old('tipo') == 1 ? 'selected' : '' }}>Horas trabajadas</option>
                                </select>
                                @if ($errors->has('tipo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tipo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <button type="submit" class="btn btn-default pull-right"><i class="fa fa-bar-chart"></i>
                                Generar Reporte</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-9 {{ $errors->has('id_docentes') ? ' has-error' : '' }}">
                            <label for="id_docentes" class="control-label col-lg-2">
                                @if ($errors->has('id_docentes'))
                                <i class="fa fa-times-circle-o"></i>
                                @endif
                                Docente(s):
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control select2" multiple="multiple" id="id_docentes" name="id_docentes[]"
                                    data-placeholder="   Vacio = Todos los docentes" style="width: 100%;">
                                    @foreach ($docentes as $docente)
                                    <option value="{{ $docente->id_banner }}"
                                        @if (old('id_docentes'))
                                            @foreach (old('id_docentes') as $idDocenteOld)
                                            {{ $docente->id_banner == $idDocenteOld ? 'selected' : '' }}
                                            @endforeach
                                        @endif
                                    >{{ $docente->docente }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_docentes'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_docentes') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 {{ $errors->has('fecha_inicial') ? ' has-error' : '' }}">
                            <label for="fecha_inicial" class="col-lg-3 control-label">
                                @if ($errors->has('fecha_inicial'))
                                <i class="fa fa-times-circle-o"></i>
                                @endif
                                Fecha Inicial:
                            </label>
                            <div class="col-lg-9">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="dateInicial"
                                        id="fecha_inicial" name="fecha_inicial" value="{{ old('fecha_inicial') }}">
                                </div>
                                @if ($errors->has('fecha_inicial'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_inicial') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-lg-6 {{ $errors->has('fecha_final') ? ' has-error' : '' }}">
                            <label for="fecha_final" class="col-lg-3 control-label">
                                @if ($errors->has('fecha_final'))
                                <i class="fa fa-times-circle-o"></i>
                                @endif
                                Fecha Final:
                            </label>
                            <div class="col-lg-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="dateFinal"
                                            id="fecha_final" name="fecha_final" value="{{ old('fecha_final') }}">
                                    </div>
                                @if ($errors->has('fecha_final'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_final') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{csrf_field()}}
            </form>
        </div>
    </div>
</div>
@endsection

@section('stylos')
<link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection


@section('scriptsheet')
<script src="{{ asset('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>
<script>
$(function() {
    $('.select2').select2()
})
$('#dateInicial').datepicker({
    locale: 'es',
    autoclose: true,
    format: 'yyyy-mm-dd',
    maxDate: Date.now(),
    allowInputToggle: true,
    ignoreReadonly: true,
})
$('#dateFinal').datepicker({
    locale: 'es',
    autoclose: true,
    format: 'yyyy-mm-dd',
    maxDate: Date.now(),
    allowInputToggle: true,
    ignoreReadonly: true,
})
</script>
@endsection
