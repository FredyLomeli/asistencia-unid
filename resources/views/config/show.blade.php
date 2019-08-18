@extends('layout')

@section('title',"Control de asistencia")

@section('asunto',"Configuración")

@section('descripcion', "Ver detalle")

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li><a href="{{ route('config.index') }}"> Configuración</a></li>
<li class="active">Ver detalle</li>
@endsection

@section('contenido')
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-xs-9 col-lg-7">
                    <a class="btn btn-default pull-right" href="{{ route('config.index') }}"><i class="fa fa-list"></i> Regresar</a>
                </div>
                <div class="col-xs-3 col-lg-1">
                    <a class="btn btn-default pull-right" href="{{ route('config.edit', $configuracion) }}"><i class="fa fa-pencil"></i> Editar</a>
                </div>
            </div>
        </div>
        <form class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label class="col-lg-3 control-label">Tipo de Configuracion:</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" value="@switch($configuracion->tipo)
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
                        @endswitch" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"> Nombre:</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" value="{{ $configuracion->nombre}}" disabled>
                </div>
            </div>
            <div class="form-group" v-if="(tipo != 5 && tipo !=4) || tipo == 0">
                <label class="col-lg-3 control-label"> Datos:</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" value="{{ $configuracion->datos}}" disabled>
                </div>
            </div>
            <div class="form-group" v-if="tipo == 4 || tipo == 0">
                <label class="col-lg-3 control-label">Fecha Inicio:</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control" value="{{ $configuracion->fec_ini }}" disabled>
                    </div>
                </div>
            </div>
            <div class="form-group" v-if="tipo == 4 || tipo == 0">
                <label class="col-lg-3 control-label"> Fecha Fin:</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control" value="{{ $configuracion->fec_fin }}" disabled>
                    </div>
                </div>
            </div>
            <div class="form-group" v-if="tipo == 5 || tipo == 0">
                <label class="col-lg-3 control-label"> Fecha:</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control" value="{{ $configuracion->fecha }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <div class="box-footer">
            <div class="row">
                <div class="row">
                    <div class="col-xs-9 col-lg-7">
                        <a class="btn btn-default pull-right" href="{{ route('config.index') }}"><i class="fa fa-list"></i> Regresar</a>
                    </div>
                    <div class="col-xs-3 col-lg-1">
                        <a class="btn btn-default pull-right" href="{{ route('config.edit', $configuracion) }}"><i class="fa fa-pencil"></i> Editar</a>
                    </div>
                </div>
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
            tipo: '{{ $configuracion->tipo }}',
            ban: true,
        },
    });
    vm.$watch('tipo', function (val) {
        if(this.tipo != '0')
            this.ban = false
        else this.ban = true
    })
</script>
@endsection
