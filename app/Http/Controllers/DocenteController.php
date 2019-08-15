<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Configuracion;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro = $request->get('filtro');
        $registros = $request->get('registros');

        if(!$registros) $registros = 15;
            
        $cabeceras = Configuracion::where('nombre','NombreCamposTablaDocente')
            ->where('tipo', 6)->value('datos');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuracion::where('nombre','CamposTablaDocente')
            ->where('tipo', 7)->value('datos');
        $campos = explode(',', $campos);
        $docentes = Docente::select($campos)
        ->orderBy('id','DESC')
        ->busqueda($filtro)
        ->paginate($registros);
        return view('docente.index',compact('docentes','campos','cabeceras','filtro','registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('docente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner',
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required',
            'comentario' => 'between:0,500',
        ]);

        Docente::create($data);
        return redirect()->route('docente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        return view('docente.show',compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        return view('docente.edit',compact('docente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente $docente)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,'.$docente->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required',
            'comentario' => 'between:0,500',
        ]);

        $docente->update($data);
        return redirect()->route('docente.show',$docente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('docente.index');
    }
}
