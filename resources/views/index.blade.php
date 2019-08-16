@extends('layout')

@section('title',"Control de asistencia")

@section('asunto')
Bienvenido
@endsection

@section('descripcion')
Sistema para el control de asistencia
@endsection

@section('migajas')
<li class="active"><i class="fa fa-dashboard"></i> Inicio</li>
@endsection

@section('contenido')
<h2 class="page-header">Docentes</h2>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('docente.index') }}">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number">DOCENTES</span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('crn.index') }}">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number">MATERIAS</span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('horarioDocente.index') }}">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-calendar-check-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number">HORARIOS</span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="{{ route('inicio') }}">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number">REPORTES</span>
                </div>
            </div>
        </a>
    </div>
</div>
<h2 class="page-header">Administrativos</h2>
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('inicio') }}">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-number">ADMINISTRATIVOS</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('inicio') }}">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-calendar-check-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-number">HORARIOS</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('inicio') }}">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-number">REPORTES</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
