<?php

namespace App\Http\Controllers;

use App\RegistroDocente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docente1 = DB::select('select * from docentes where nombre LIKE "%alf%" ');
        $docente2 = DB::select('select * from docentes where nombre LIKE "%gui%" ');
        $docente3 = DB::select('select * from docentes where nombre LIKE "%mar%" ');
        // $docente1 = Docente::where('nombre', 'LIKE', '%alf%');
        // $docente2 = Docente::where('nombre', 'LIKE', '%gui%');
        // $docente3 = Docente::where('nombre', 'LIKE', '%mar%');
        $docentes['docente1'] = $docente1;
        $docentes['docente2'] = $docente2;
        $docentes['docente3'] = $docente3;

        dd($docentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegistroDocente  $registroDocente
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroDocente $registroDocente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegistroDocente  $registroDocente
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistroDocente $registroDocente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistroDocente  $registroDocente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroDocente $registroDocente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistroDocente  $registroDocente
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistroDocente $registroDocente)
    {
        //
    }
}
