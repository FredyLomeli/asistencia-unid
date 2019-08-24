@extends('layout')

@section('title',"Control de asistencia")

@section('asunto',"Nueva Configuracion")

@section('descripcion', "Creación de registro")

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li><a href="{{ route('config.index') }}"> Configuracion</a></li>
<li class="active">Creación</li>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <form class="form-horizontal" method="post" action="{{ route('config.store') }}">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-xs-9 col-lg-7">
                            <a class="btn btn-default pull-right" href="{{ route('config.index') }}"><i
                                    class="fa fa-list"></i> Regresar</a>
                        </div>
                        <div class="col-xs-3 col-lg-1">
                            <button type="submit" class="btn btn-default pull-right" :disabled="ban === true"><i
                                    class="fa fa-save"></i> Guardar</button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                        <label for="tipo" class="col-lg-3 control-label">
                            @if ($errors->has('tipo'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Tipo de Configuracion</label>
                        <div class="col-lg-5">
                            <select class="form-control" id="tipo" name="tipo" v-model="tipo">
                                <option value="4" {{ old('tipo') == 4 ? 'selected' : '' }}>Calendario</option>
                                <option value="5" {{ old('tipo') == 5 ? 'selected' : '' }}>Asueto</option>
                                <option value="3" {{ old('tipo') == 3 ? 'selected' : '' }}>Contraseña</option>
                                <option value="6" {{ old('tipo') == 6 ? 'selected' : '' }}>Nombre de Campos (tabla)
                                </option>
                                <option value="7" {{ old('tipo') == 7 ? 'selected' : '' }}>Campos de Tabla</option>
                                <option value="8" {{ old('tipo') == 8 ? 'selected' : '' }}>Tamaño de Campos (tabla)
                                </option>
                                <option value="9" {{ old('tipo') == 9 ? 'selected' : '' }}>Nombre de Campos Filtro
                                    (tabla)</option>
                                <option value="10" {{ old('tipo') == 10 ? 'selected' : '' }}>Campos de filtro (tabla)
                                </option>
                                <option value="11" {{ old('tipo') == 11 ? 'selected' : '' }}>Limite de Regristro (tabla)
                                </option>
                            </select>
                            @if ($errors->has('tipo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tipo') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-lg-3 control-label">
                            @if ($errors->has('nombre'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Nombre:</label>
                        <div class="col-lg-3">
                            <input type="text" minlength="1" maxlength="250" class="form-control" id="nombre"
                                name="nombre" placeholder="AsuetoBenito2020" value="{{ old('nombre') }}">
                            @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('datos') ? ' has-error' : '' }}"
                        v-if="(tipo != 5 && tipo !=4) || tipo == 0">
                        <label for="datos" class="col-lg-3 control-label">
                            @if ($errors->has('datos'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Datos:</label>
                        <div class="col-lg-5">
                            <input type="text" maxlength="250" class="form-control" id="datos" name="datos"
                                placeholder="configuracion" value="{{ old('datos')}}" :disabled="ban === true">
                            @if ($errors->has('datos'))
                            <span class="help-block">
                                <strong>{{ $errors->first('datos') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('fec_ini') ? ' has-error' : '' }}"
                        v-if="tipo == 4 || tipo == 0">
                        <label for="fec_ini" class="col-lg-3 control-label">
                            @if ($errors->has('fec_ini'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Fecha Inicio:</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'"
                                    id="fec_ini" name="fec_ini" value="{{ old('fec_ini')}}" data-mask
                                    :disabled="ban === true">
                                @if ($errors->has('fec_ini'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fec_ini') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('fec_fin') ? ' has-error' : '' }}"
                        v-if="tipo == 4 || tipo == 0">
                        <label for="fec_fin" class="col-lg-3 control-label">
                            @if ($errors->has('fec_fin'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Fecha Fin:</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'"
                                    id="fec_fin" name="fec_fin" value="{{ old('fec_fin')}}" data-mask
                                    :disabled="ban === true">
                                @if ($errors->has('fec_fin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fec_fin') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}"
                        v-if="tipo == 5 || tipo == 0">
                        <label for="fecha" class="col-lg-3 control-label">
                            @if ($errors->has('fecha'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Fecha:</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'"
                                    id="fecha" name="fecha" value="{{ old('fecha')}}" data-mask
                                    :disabled="ban === true">
                                @if ($errors->has('fecha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="row">
                            <div class="col-xs-9 col-lg-7">
                                <a class="btn btn-default pull-right" href="{{ route('config.index') }}"><i
                                        class="fa fa-list"></i> Regresar</a>
                            </div>
                            <div class="col-xs-3 col-lg-1">
                                <button type="submit" class="btn btn-default pull-right" :disabled="ban === true"><i
                                        class="fa fa-save"></i> Guardar</button>
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

@section('scriptsheet')
<script src="{{ asset('input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    var vm = new Vue({
        el: '#frexal',
        data: {
            tipo: '{{ old('tipo',0) }}',
            ban: {{ old('tipo','true') === 'true' ? 'true' : 'false' }},
        },
    });
    vm.$watch('tipo', function (val) {
        if(this.tipo != '0'){
            this.ban = false
            $('#datemask').inputmask('dd/mm/yyyy', {
                    'placeholder': 'dd/mm/yyyy'
            })
            $('[data-mask]').inputmask()
        }
        else this.ban = true
    })
</script>
@endsection
