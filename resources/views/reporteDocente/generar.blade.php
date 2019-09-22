@extends('layout')

@section('body')
<body class="skin-blue sidebar-mini sidebar-collapse">
@endsection
@section('title',"Reporte Docentes")

@section('header')
<div class="box box-default collapsed-box">
    <div class="box-header with-border">
    <h3 class="box-title">Datos de generacion del reporte</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="form-group col-lg-4">
                <label for="tipo" class="col-lg-4 control-label">Tipo de Reporte</label>
                <div class="col-lg-8" id="tipo">
                    <input class="form-control" type="text" value="{{ $data['tipoNombre'] }}" readonly>
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label class="col-lg-4 control-label">Fecha Inicial:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" value="{{ $data['fecha_inicial'] }}" readonly>
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label class="col-lg-4 control-label">Fecha Final:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" value="{{ $data['fecha_final'] }}" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <label class="control-label col-lg-1">Docente(s): </label>
                <div class="col-lg-11">
                    <input class="form-control" type="text" value="{{ $data['id_docentes_total'] }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <iframe width="100%" height="400"
                src="{{ route('reporte.view',[
                    'tipo' => $data['tipo'],
                    'fecha_inicial' => $data['fecha_inicial'],
                    'fecha_final' => $data['fecha_final'],
                    'id_docentes' => $data['id_docentes_total'],
                ]) }}" frameborder="0" allowfullscreen></iframe>
            </div>
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
    format: 'dd-mm-yyyy',
    maxDate: Date.now(),
    allowInputToggle: true,
    ignoreReadonly: true,
})
$('#dateFinal').datepicker({
    locale: 'es',
    autoclose: true,
    format: 'dd-mm-yyyy',
    maxDate: Date.now(),
    allowInputToggle: true,
    ignoreReadonly: true,
})
</script>
@endsection
