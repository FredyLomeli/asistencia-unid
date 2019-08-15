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

Route::get('/configuraciones', 'ConfiguracionController@index')
    ->name('configuracion.index');
Route::get('/configuraciones/nuevo', 'ConfiguracionController@create')
    ->name('configuracion.create');
Route::post('/configuraciones/crear', 'ConfiguracionController@store')
    ->name('configuracion.store');
Route::get('/configuraciones/{configuracion}', 'ConfiguracionController@show')
    ->where('configuracion', '[0-9]+')->name('configuracion.show');
Route::get('/configuraciones/{configuracion}/editar', 'ConfiguracionController@edit')
    ->where('configuracion', '[0-9]+')->name('configuracion.edit');
Route::put('/configuraciones/{configuracion}/actualizar', 'ConfiguracionController@update')
    ->where('configuracion', '[0-9]+')->name('configuracion.update');
Route::delete('/configuraciones/{configuracion}/delete', 'ConfiguracionController@destroy')
    ->where('configuracion', '[0-9]+')->name('configuracion.destroy');

Route::get('/crns', 'CrnController@index')
    ->name('crn.index');
Route::get('/crns/nuevo', 'CrnController@create')
    ->name('crn.create');
Route::post('/crns/crear', 'CrnController@store')
    ->name('crn.store');
Route::get('/crns/{crn}', 'CrnController@show')
    ->where('crn', '[0-9]+')->name('crn.show');
Route::get('/crns/{crn}/editar', 'CrnController@edit')
    ->where('crn', '[0-9]+')->name('crn.edit');
Route::put('/crns/{crn}/actualizar', 'CrnController@update')
    ->where('crn', '[0-9]+')->name('crn.update');
Route::delete('/crns/{crn}/delete', 'CrnController@destroy')
    ->where('crn', '[0-9]+')->name('crn.destroy');

Route::get('/horario/docente', 'HorarioMateriaDocenteController@index')
    ->name('horarioDocente.index');
Route::get('/horario/docente/nuevo', 'HorarioMateriaDocenteController@create')
    ->name('horarioDocente.create');
Route::post('/horario/docente/crear', 'HorarioMateriaDocenteController@store')
    ->name('horarioDocente.store');
Route::get('/horario/docente/{HorarioMateriaDocente}', 'HorarioMateriaDocenteController@show')
    ->where('HorarioMateriaDocente', '[0-9]+')->name('horarioDocente.show');
Route::get('/horario/docente/{HorarioMateriaDocente}/editar', 'HorarioMateriaDocenteController@edit')
    ->where('HorarioMateriaDocente', '[0-9]+')->name('horarioDocente.edit');
Route::put('/horario/docente/{HorarioMateriaDocente}/actualizar', 'HorarioMateriaDocenteController@update')
    ->where('HorarioMateriaDocente', '[0-9]+')->name('horarioDocente.update');
Route::delete('/horario/docente/{HorarioMateriaDocente}/delete', 'HorarioMateriaDocenteController@destroy')
    ->where('HorarioMateriaDocente', '[0-9]+')->name('horarioDocente.destroy');
