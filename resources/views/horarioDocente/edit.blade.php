@extends('layout')

@section('title',"Control de asistencia")

@section('asunto', "Horario")

@section('descripcion', "Edición de registro")

@section('migajas')
<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
<li><a href="{{ route('horarioDocente.index') }}"> Horario Docente</a></li>
<li class="active">Edición</li>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <form class="form-horizontal" method="post"
                action="{{ route('horarioDocente.update', $horarioMateriaDocente) }}">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-xs-6 col-lg-6">
                            <a class="btn btn-default pull-right" href="{{ route('horarioDocente.index') }}"><i
                                    class="fa fa-list"></i> Regresar</a>
                        </div>
                        <div class="col-xs-3 col-lg-1">
                            <a class="btn btn-default pull-right"
                                href="{{ route('horarioDocente.show', $horarioMateriaDocente) }}"><i
                                    class="fa fa-times"></i> Cancelar</a>
                        </div>
                        <div class="col-xs-3 col-lg-1">
                            <button type="submit" class="btn btn-default pull-right"><i class="fa fa-save"></i>
                                Guardar</button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group {{ $errors->has('id_docente') ? ' has-error' : '' }}">
                        <label for="id_docente" class="col-lg-3 control-label">
                            @if ($errors->has('id_docente'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            ID Docente:</label>
                        <div class="col-lg-3">
                            <input type="text" minlength="8" maxlength="250" class="form-control" id="id_docente"
                                name="id_docente" placeholder="00091819 Alfredo Lomelí"
                                value="{{ old('id_docente', $horarioMateriaDocente->id_docente) }}" readonly>
                            @if ($errors->has('id_docente'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id_docente') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-1">
                            <a class="btn btn-default" data-toggle="modal" data-target="#myModal">
                            <li class="fa fa-search"></li></a>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('crn') ? ' has-error' : '' }}">
                        <label for="crn" class="col-lg-3 control-label">
                            @if ($errors->has('crn'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            CRN:</label>
                        <div class="col-lg-3">
                            <input type="text" minlength="8" maxlength="250" class="form-control" id="crn" name="crn"
                                placeholder="63454 Tecnologia Educativa"
                                value="{{ old('crn', $horarioMateriaDocente->crn) }}" readonly>
                            @if ($errors->has('crn'))
                            <span class="help-block">
                                <strong>{{ $errors->first('crn') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-1">
                            <a class="btn btn-default" data-toggle="modal" data-target="#myModall">
                            <li class="fa fa-search"></li></a>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                        <label for="descripcion" class="col-lg-3 control-label">
                            @if ($errors->has('descripcion'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Descripcion:</label>
                        <div class="col-lg-3">
                            <input type="text" minlength="8" maxlength="250" class="form-control" id="descripcion" name="descripcion"
                                placeholder="63454 Tecnologia Educativa"
                                value="{{ old('descripcion', $horarioMateriaDocente->descripcion) }}" readonly>
                            @if ($errors->has('descripcion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('calendario') ? ' has-error' : '' }}">
                        <label for="calendario" class="col-lg-3 control-label">
                            @if ($errors->has('calendario'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Calendario:</label>
                        <div class="col-lg-5">
                            <select class="form-control" id="calendario" name="calendario" v-model="calendario">
                                @foreach ($calendarios as $calendario)
                                <option value="{{ $calendario->nombre }}|{{ $calendario->datos }}">
                                    {{ $calendario->nombre }}</option>
                                @endforeach
                                <option value="Personalizado||"> Personalizado</option>
                            </select>
                            @if ($errors->has('calendario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('calendario') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('fecha_vig_ini') ? ' has-error' : '' }}">
                        <label for="fecha_vig_ini" class="col-lg-3 control-label">
                            @if ($errors->has('fecha_vig_ini'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Fecha Inicio:</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'"
                                    id="fecha_vig_ini" name="fecha_vig_ini" v-model="fechaInicio" data-mask :readonly="calendar!='Personalizado'">
                                @if ($errors->has('fecha_vig_ini'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_vig_ini') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('fecha_vig_fin') ? ' has-error' : '' }}">
                        <label for="fecha_vig_fin" class="col-lg-3 control-label">
                            @if ($errors->has('fecha_vig_fin'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Fecha Fin:</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'"
                                    id="fecha_vig_fin" name="fecha_vig_fin" v-model="fechaFin" data-mask :readonly="calendar!='Personalizado'">
                                @if ($errors->has('fecha_vig_fin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_vig_fin') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('dia') ? ' has-error' : '' }}">
                        <label for="dia" class="col-lg-3 control-label">
                            @if ($errors->has('dia'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Dia:</label>
                        <div class="col-lg-5">
                            <select class="form-control" id="dia" name="dia">
                                <option value="0" {{ old('dia', $horarioMateriaDocente->dia) == 0 ? 'selected' : '' }}>
                                    Domingo</option>
                                <option value="1" {{ old('dia', $horarioMateriaDocente->dia) == 1 ? 'selected' : '' }}>
                                    Lunes</option>
                                <option value="2" {{ old('dia', $horarioMateriaDocente->dia) == 2 ? 'selected' : '' }}>
                                    Martes</option>
                                <option value="3" {{ old('dia', $horarioMateriaDocente->dia) == 3 ? 'selected' : '' }}>
                                    Miercoles</option>
                                <option value="4" {{ old('dia', $horarioMateriaDocente->dia) == 4 ? 'selected' : '' }}>
                                    Jueves</option>
                                <option value="5" {{ old('dia', $horarioMateriaDocente->dia) == 5 ? 'selected' : '' }}>
                                    Viernes</option>
                                <option value="6" {{ old('dia', $horarioMateriaDocente->dia) == 6 ? 'selected' : '' }}>
                                    Sabado</option>
                            </select>
                            @if ($errors->has('dia'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dia') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('hora_ini') ? ' has-error' : '' }}">
                        <label for="hora_ini" class="col-lg-3 control-label">
                            @if ($errors->has('hora_ini'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Hora de entrada:</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'hh:mm:ss'"
                                    id="hora_ini" name="hora_ini" placeholder="hh:mm:ss"
                                    value="{{ old('hora_ini', $horarioMateriaDocente->hora_ini)}}" data-mask>
                                @if ($errors->has('hora_ini'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hora_ini') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('hora_fin') ? ' has-error' : '' }}">
                        <label for="hora_fin" class="col-lg-3 control-label">
                            @if ($errors->has('hora_fin'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Hora de Salida:</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'hh:mm:ss'"
                                    id="hora_fin" name="hora_fin" placeholder="hh:mm:ss"
                                    value="{{ old('hora_fin', $horarioMateriaDocente->hora_fin)}}" data-mask>
                                @if ($errors->has('hora_fin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hora_fin') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('grupo') ? ' has-error' : '' }}">
                        <label for="grupo" class="col-lg-3 control-label">
                            @if ($errors->has('grupo'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Grupo:</label>
                        <div class="col-lg-3">
                            <input type="text" maxlength="250" class="form-control" id="grupo" name="grupo"
                                placeholder="6to-b" value="{{ old('grupo', $horarioMateriaDocente->grupo) }}">
                            @if ($errors->has('grupo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('grupo') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('comentario') ? ' has-error' : '' }}">
                        <label for="comentario" class="col-lg-3 control-label">
                            @if ($errors->has('comentario'))
                            <i class="fa fa-times-circle-o"></i>
                            @endif
                            Comentario:</label>
                        <div class="col-lg-3">
                            <textarea type="text" maxlength="500" class="form-control" id="comentario"
                                name="comentario">{{ old('comentario', $horarioMateriaDocente->comentario) }}</textarea>
                            @if ($errors->has('comentario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comentario') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-6 col-lg-6">
                            <a class="btn btn-default pull-right" href="{{ route('horarioDocente.index') }}"><i
                                    class="fa fa-list"></i> Regresar</a>
                        </div>
                        <div class="col-xs-3 col-lg-1">
                            <a class="btn btn-default pull-right"
                                href="{{ route('horarioDocente.show', $horarioMateriaDocente) }}"><i
                                    class="fa fa-times"></i> Cancelar</a>
                        </div>
                        <div class="col-xs-3 col-lg-1">
                            <button type="submit" class="btn btn-default pull-right"><i class="fa fa-save"></i>
                                Guardar</button>
                        </div>
                    </div>
                </div>
                {{method_field('PUT')}} {{csrf_field()}}
            </form>
        </div>
    </div>
</div>
@endsection

@section('modals')
<div class="modal modal-success fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header -danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Busqueda de Docente</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="form-group">
                        <label for="docente" class="col-lg-3 control-label"> Busqueda Docente:</label>
                        <div class="col-lg-9">
                            <input type="text" minlength="8" maxlength="250" class="form-control" id="docente"
                                name="docente" placeholder="00091819 Alfredo Lomelí" >
                                <p>Ingresa el nombre o ID del docente para mostrar la lista de coincidencias, da click sobre el docente que deseas.</p>
                            <div id="docenteList"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-success fade" id="myModall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header -danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Busqueda de Materia</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="form-group">
                        <label for="materia" class="col-lg-3 control-label"> Busqueda Materia:</label>
                        <div class="col-lg-9">
                            <input type="text" minlength="8" maxlength="250" class="form-control" id="materia"
                                name="materia" placeholder="63454 Tecnologia Educativa" >
                                <p>Ingresa el nombre o CRN de la Materia para mostrar la lista de coincidencias, da click sobre la materia que deseas.</p>
                            <div id="crnList"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scriptsheet')
<script src="{{ asset('input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script>
$(function() {
    $('#datemask').inputmask('yyyy-mm-dd', {
        'placeholder': 'yyyy-mm-dd'
    });
    $('#datemask2').inputmask('hh:mm:ss', {
        'placeholder': 'hh:mm:ss',
      });
    $('[data-mask]').inputmask();
})
</script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    var vm = new Vue({
        el: '#frexal',
        data: {
            fechaInicio : '{{ old('fecha_vig_ini', $horarioMateriaDocente->fecha_vig_ini)}}',
            fechaFin : '{{ old('fecha_vig_fin', $horarioMateriaDocente->fecha_vig_fin)}}',
            calendario: '{{ old('calendario', $horarioMateriaDocente->calendario === 'Personalizado' ? 'Personalizado||' : $horarioMateriaDocente->calendario.'|'.date("d/m/Y", strtotime($horarioMateriaDocente->fecha_vig_ini)).' | '.date("d/m/Y", strtotime($horarioMateriaDocente->fecha_vig_fin))) }}',
            calendar: '{{ old('calendario') === 'Personalizado||' ? 'Personalizado' : old('calendario', $horarioMateriaDocente->calendario) }}',
        },
    });
    vm.$watch('calendario', function (val) {
        var arrayDeCadenas = this.calendario.split('|');
        this.calendar = arrayDeCadenas[0];
        fec_ini = arrayDeCadenas[1].split('/');
        fec_fin = arrayDeCadenas[2].split('/');
        this.fechaInicio = fec_ini[2].trim() + "-" + fec_ini[1].trim() + "-" + fec_ini[0].trim();
        this.fechaFin = fec_fin[2].trim() + "-" + fec_fin[1].trim() + "-" + fec_fin[0].trim();
    })
</script>

<script>
$(document).ready(function(){
    $('#docente').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{ route('docente.autocomplete') }}",
            method:"POST",
            data:{query:query, _token:_token},
            success:function(data){
            $('#docenteList').fadeIn();
                    $('#docenteList').html(data);
            }
            });
        }
    });
    $('#materia').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{ route('crn.autocomplete') }}",
            method:"POST",
            data:{query:query, _token:_token},
            success:function(data){
            $('#crnList').fadeIn();
                    $('#crnList').html(data);
            }
            });
        }
    });
    $(document).on('click', '.doc', function(){
        var value = $(this).text().split('-');
        $('#docente').val($(this).text());
        $('#id_docente').val(value[0].trim());
        $('#docenteList').fadeOut();
    });
    $(document).on('click', '.mat', function(){
        var value = $(this).text().split('-');
        $('#materia').val($(this).text());
        $('#crn').val(value[0].trim());
        $('#descripcion').val(value[1].trim());
        $('#crnList').fadeOut();
    });
});
</script>
@endsection
