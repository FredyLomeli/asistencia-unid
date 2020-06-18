@extends('layout.main')

@section('title',"Nuevo usuario")

@section('descripcion')
Nuevo Usuario
@endsection

@section('acciones')
@endsection

@section('migajas')
<li class="breadcrumb-item"><a href="{{ route('usuarios') }}">Usuarios</a></li>
<li class="breadcrumb-item active">Crear</li>
@endsection

@section('contenido')
<form class="form-horizontal">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Datos generales</h3>
            <div class="float-right">
                <button type="submit" class="btn btn-default btn-sm">Regresar</button>
                &nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-default btn-sm">Guardar</button>
            </div>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <label for="id_banner" class="form-control-label col-sm-1">ID :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control{{ $errors->has('id_banner') ? ' is-invalid' : '' }}" required
                        minlength="8" maxlength="10" id="id_banner" placeholder="00091819" value="{{ old('id_banner') }}">
                    @if ($errors->has('id_banner'))
                        <div class="invalid-feedback">{{ $errors->first('id_banner') }}</div>
                    @endif
                </div>
                <label for="name" class="form-control-label col-sm-1">Nombre :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required
                        minlength="8" maxlength="255" id="name" placeholder="Alfredo" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="apellidos" class="form-control-label col-sm-1">Apellidos :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" required
                        minlength="1" maxlength="255" id="apellidos" placeholder="Lomeli Ramirez" value="{{ old('apellidos') }}">
                    @if ($errors->has('apellidos'))
                        <div class="invalid-feedback">{{ $errors->first('apellidos') }}</div>
                    @endif
                </div>
                <label for="email" class="form-control-label col-sm-1">Correo :</label>
                <div class="col-sm-5">
                    <input ype="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                        minlength="1" maxlength="191" id="email" placeholder="alfredo.lomeli@unid.mx" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="curp" class="form-control-label col-sm-1">CURP :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control{{ $errors->has('curp') ? ' is-invalid' : '' }}"
                        minlength="1" maxlength="20" id="curp" placeholder="LORA5465456465" value="{{ old('curp') }}">
                    @if ($errors->has('curp'))
                        <div class="invalid-feedback">{{ $errors->first('curp') }}</div>
                    @endif
                </div>
                <label for="rfc" class="form-control-label col-sm-1">RFC :</label>
                <div class="col-sm-5">
                    <input ype="rfc" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}"
                        minlength="1" maxlength="15" id="rfc" placeholder="LORA56546" value="{{ old('rfc') }}">
                    @if ($errors->has('rfc'))
                        <div class="invalid-feedback">{{ $errors->first('rfc') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="no_nomina" class="form-control-label col-sm-1">No. Nomina :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control{{ $errors->has('no_nomina') ? ' is-invalid' : '' }}"
                        minlength="1" maxlength="20" id="no_nomina" placeholder="LORA5465456465" value="{{ old('no_nomina') }}">
                    @if ($errors->has('no_nomina'))
                        <div class="invalid-feedback">{{ $errors->first('no_nomina') }}</div>
                    @endif
                </div>
                <label for="domicilio" class="form-control-label col-sm-1">Domicilio :</label>
                <div class="col-sm-5">
                    <input ype="domicilio" class="form-control{{ $errors->has('domicilio') ? ' is-invalid' : '' }}"
                        minlength="1" maxlength="255" id="domicilio" placeholder="LORA56546" value="{{ old('domicilio') }}">
                    @if ($errors->has('domicilio'))
                        <div class="invalid-feedback">{{ $errors->first('domicilio') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="cargos_id" class="form-control-label col-sm-1">Cargo :</label>
                <div class="col-sm-5">
                    <select class="form-control" id="estado" name="estado">
                        <option value="1" {{ old('estado') === 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') === 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @if ($errors->has('cargos_id'))
                        <div class="invalid-feedback">{{ $errors->first('cargos_id') }}</div>
                    @endif
                </div>
                <label for="estado" class="form-control-label col-sm-1">Estado :</label>
                <div class="col-sm-5">
                     <select class="form-control" id="estado" name="estado">
                        <option value="1" {{ old('estado') === 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') === 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @if ($errors->has('estado'))
                        <div class="invalid-feedback">{{ $errors->first('estado') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card card-secondary">
        <div class="card-header" >
            <h3 class="card-title">Permisos</h3>
            <div class="float-right">
                <button type="submit" class="btn btn-default btn-sm">Regresar</button>
                &nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-default btn-sm">Guardar</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="form-control-label">Promocion :</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="nuevo_avance_promo">
                            <label class="form-check-label" for="nuevo_avance_promo">Nuevo Avance</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="consulta_avance_promo">
                            <label class="form-check-label" for="consulta_avance_promo">Consultar Avance</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="consulta_avance_promo_general">
                            <label class="form-check-label" for="consulta_avance_promo_general">Consulta Avance General</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="cancelar_avace_promo">
                            <label class="form-check-label" for="cancelar_avace_promo">Cancelar Avance</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="cargos_id" class="form-control-label">Promocion :</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="nuevo_inscrito_promo">
                            <label class="form-check-label" for="nuevo_inscrito_promo">Nuevo inscrito</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="consulta_inscrito_promo">
                            <label class="form-check-label" for="consulta_inscrito_promo">Consultar inscrito</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="edicion_inscrito_promo">
                            <label class="form-check-label" for="edicion_inscrito_promo">Editar Inscrito</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="consulta_inscrito_promo_general">
                            <label class="form-check-label" for="consulta_inscrito_promo_general">Consultar inscrito General</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="cargos_id" class="form-control-label">Promocion :</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="nuevo_prospeccion_promo">
                            <label class="form-check-label" for="nuevo_prospeccion_promo">Nueva prospeccion</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="consulta_prospeccion_promo">
                            <label class="form-check-label" for="consulta_prospeccion_promo">Consulta prospeccion</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="edicion_prospeccion_promo">
                            <label class="form-check-label" for="edicion_prospeccion_promo">Editar prospeccion</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="consulta_prospeccion_promo_general">
                            <label class="form-check-label" for="consulta_prospeccion_promo_general">Consulta prospeccion general</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="cargos_id" class="form-control-label">Promocion :</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="nuevo_periodo_promo">
                            <label class="form-check-label" for="nuevo_periodo_promo">Nueva periodo</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="consulta_periodo_promo">
                            <label class="form-check-label" for="consulta_periodo_promo">Consulta periodo</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="editar_periodo_promo">
                            <label class="form-check-label" for="editar_periodo_promo">Editar periodo</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="cancelar_periodo_promo">
                            <label class="form-check-label" for="cancelar_periodo_promo">Cancelar periodo</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="cargos_id" class="form-control-label">Cargo :</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="cargos_id" class="form-control-label">Cargo :</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">Remember me</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-secondary">
        <div class="card-header" >
            <h3 class="card-title">Campos Adicionales</h3>
            <div class="float-right">
                <button type="submit" class="btn btn-default btn-sm">Regresar</button>
                &nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-default btn-sm">Guardar</button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="comentario" class="form-control-label col-sm-1">Comentario :</label>
                <div class="col-sm-11">
                    <textarea type="text" class="form-control{{ $errors->has('comentario') ? ' is-invalid' : '' }}"
                        maxlength="500" id="comentario" placeholder="Comentarios">{{ old('comentario') }}</textarea>
                    @if ($errors->has('comentario'))
                        <div class="invalid-feedback">{{ $errors->first('comentario') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="adicional1" class="form-control-label col-sm-1">Adicional 1 :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control{{ $errors->has('adicional1') ? ' is-invalid' : '' }}"
                        minlength="1" maxlength="255" id="adicional1" placeholder="Campos Adicional" value="{{ old('adicional1') }}">
                    @if ($errors->has('adicional1'))
                        <div class="invalid-feedback">{{ $errors->first('adicional1') }}</div>
                    @endif
                </div>
                <label for="adicional2" class="form-control-label col-sm-1">Adicional 2 :</label>
                <div class="col-sm-5">
                    <input ype="adicional2" class="form-control{{ $errors->has('adicional2') ? ' is-invalid' : '' }}"
                        minlength="1" maxlength="255" id="adicional2" placeholder="Campos Adicional" value="{{ old('adicional2') }}">
                    @if ($errors->has('adicional2'))
                        <div class="invalid-feedback">{{ $errors->first('adicional2') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="adicional3" class="form-control-label col-sm-1">Adicional 3 :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control{{ $errors->has('adicional3') ? ' is-invalid' : '' }}"
                        minlength="1" maxlength="255" id="adicional3" placeholder="Campos Adicional" value="{{ old('adicional3') }}">
                    @if ($errors->has('adicional3'))
                        <div class="invalid-feedback">{{ $errors->first('adicional3') }}</div>
                    @endif
                </div>
                <label for="adicional4" class="form-control-label col-sm-1">Adicional 4 :</label>
                <div class="col-sm-5">
                    <input ype="adicional4" class="form-control{{ $errors->has('adicional4') ? ' is-invalid' : '' }}"
                        minlength="1" maxlength="255" id="adicional4" placeholder="Campos Adicional" value="{{ old('adicional4') }}">
                    @if ($errors->has('adicional4'))
                        <div class="invalid-feedback">{{ $errors->first('adicional4') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</form>
@endsection

@section('configuracion')
hola gola
@endsection

@section('modals')
@endsection

@section('jscripts')
@endsection
