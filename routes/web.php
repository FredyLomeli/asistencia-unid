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

Route::get('/docentes', 'DocenteController@index')->name('docente.index');
Route::get('/docentes/{docente}', 'DocenteController@index')
    ->where('docente', '[0-9]+')->name('docente.show');
Route::get('/docentes/{docente}/editar', 'DocenteController@edit')
    ->where('docente', '[0-9]+')->name('docente.edit');
Route::delete('/docentes/{docente}/delete', 'DocenteController@destroy')
    ->where('docente', '[0-9]+')->name('docente.destroy');
