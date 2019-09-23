<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('inicio');

Route::get('/docentes', 'DocenteController@index')
    ->name('docente.index');
Route::get('/docentes/nuevo', 'DocenteController@create')
    ->name('docente.create');
Route::post('/docentes/crear', 'DocenteController@store')
    ->name('docente.store');
Route::get('/docentes/{docente}', 'DocenteController@show')
    ->where('docente', '[0-9]+')->name('docente.show');
Route::get('/docentes/{docente}/editar', 'DocenteController@edit')
    ->where('docente', '[0-9]+')->name('docente.edit');
Route::put('/docentes/{docente}/actualizar', 'DocenteController@update')
    ->where('docente', '[0-9]+')->name('docente.update');
Route::delete('/docentes/{docente}/delete', 'DocenteController@destroy')
    ->where('docente', '[0-9]+')->name('docente.destroy');
Route::post('/docentes/autocomplete', 'docenteController@autocomplete')->name('docente.autocomplete');

Route::get('/configuraciones', 'ConfiguracionController@index')
    ->name('config.index');
Route::get('/configuraciones/nuevo', 'ConfiguracionController@create')
    ->name('config.create');
Route::post('/configuraciones/crear', 'ConfiguracionController@store')
    ->name('config.store');
Route::get('/configuraciones/{configuracion}', 'ConfiguracionController@show')
    ->where('configuracion', '[0-9]+')->name('config.show');
Route::get('/configuraciones/{configuracion}/editar', 'ConfiguracionController@edit')
    ->where('configuracion', '[0-9]+')->name('config.edit');
Route::put('/configuraciones/{configuracion}/actualizar', 'ConfiguracionController@update')
    ->where('configuracion', '[0-9]+')->name('config.update');
Route::delete('/configuraciones/{configuracion}/delete', 'ConfiguracionController@destroy')
    ->where('configuracion', '[0-9]+')->name('config.destroy');

Route::get('/materias', 'CrnController@index')
    ->name('crn.index');
Route::get('/materias/nuevo', 'CrnController@create')
    ->name('crn.create');
Route::post('/materias/crear', 'CrnController@store')
    ->name('crn.store');
Route::get('/materias/{crn}', 'CrnController@show')
    ->where('crn', '[0-9]+')->name('crn.show');
Route::get('/materias/{crn}/editar', 'CrnController@edit')
    ->where('crn', '[0-9]+')->name('crn.edit');
Route::put('/materias/{crn}/actualizar', 'CrnController@update')
    ->where('crn', '[0-9]+')->name('crn.update');
Route::delete('/materias/{crn}/delete', 'CrnController@destroy')
    ->where('crn', '[0-9]+')->name('crn.destroy');
Route::post('/materias/autocomplete', 'CrnController@autocomplete')->name('crn.autocomplete');

Route::get('/horario/docente', 'HorarioMateriaDocenteController@index')
    ->name('horarioDocente.index');
Route::get('/horario/docente/nuevo', 'HorarioMateriaDocenteController@create')
    ->name('horarioDocente.create');
Route::post('/horario/docente/crear', 'HorarioMateriaDocenteController@store')
    ->name('horarioDocente.store');
Route::get('/horario/docente/{horarioMateriaDocente}', 'HorarioMateriaDocenteController@show')
    ->where('HorarioMateriaDocente', '[0-9]+')->name('horarioDocente.show');
Route::get('/horario/docente/{horarioMateriaDocente}/editar', 'HorarioMateriaDocenteController@edit')
    ->where('HorarioMateriaDocente', '[0-9]+')->name('horarioDocente.edit');
Route::put('/horario/docente/{horarioMateriaDocente}/actualizar', 'HorarioMateriaDocenteController@update')
    ->where('HorarioMateriaDocente', '[0-9]+')->name('horarioDocente.update');
Route::delete('/horario/docente/{horarioMateriaDocente}/delete', 'HorarioMateriaDocenteController@destroy')
    ->where('HorarioMateriaDocente', '[0-9]+')->name('horarioDocente.destroy');

Route::get('/reporte/docente', 'ReportesController@indexDocente')->name('reporteDocente.index');
Route::post('/reporte/docente', 'ReportesController@generarReporteDocente')->name('reporteDocente.generar');


//Test generar variable multidimencional
Route::get('/reporte', 'RegistroDocenteController@index')->name('testReporteDocente.index');
// Test PDF VIEW
Route::get('/reporte/view', 'ReportesController@view')->name('reporte.views');
// Test PDF VIEW
Route::get('/reporte/pdf/{tipo}/{fecha_inicial}/{fecha_final}/{id_docentes}', 'ReportesController@viewPdf')
    ->name('reporte.view');

// Test Excel Download
Route::get('/reporte/excel/{tipo}/{fecha_inicial}/{fecha_final}/{id_docentes}', 'ReportesController@downloadExcel')
->name('reporte.download');

