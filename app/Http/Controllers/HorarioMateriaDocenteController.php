<?php

namespace App\Http\Controllers;

use App\Configuracion;
use App\HorarioMateriaDocente;
use Illuminate\Http\Request;

class HorarioMateriaDocenteController extends Controller
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
        $cabeceras = Configuracion::where('nombre','NombreCamposTablaMaterias')
            ->where('tipo', 6)->value('datos');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuracion::where('nombre','CamposTablaMaterias')
            ->where('tipo', 7)->value('datos');
        $campos = explode(',', $campos);
        $horarioMateriaDocente = HorarioMateriaDocente::select($campos)
        ->orderBy('id','DESC')
        ->busqueda($filtro)
        ->paginate($registros);
        return view('horaroDocente.index',compact('horarioMateriaDocente','campos','cabeceras','filtro','registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horaroDocente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->all();
        $data = request()->validate([
            'crn' => 'required|between:5,8|exists:crn,crn',
            'descripcion' => 'required|between:1,250',
            'id_docente' => 'required|between:8,10|exists:docentes,id_banner',
            'dia' => 'required|integer|between:1,7',
            'fecha_vig_ini' => 'required|date_format:Y-m-d|before_or_equal:' . $data['fecha_vig_fin'],
            'fecha_vig_fin' => 'required|date_format:Y-m-d',
            'hora_ini' => 'required|date_format:H:i:s|before_or_equal:' . $data['hora_fin'],
            'hora_fin' => 'required|date_format:H:i:s',
            'grupo' => 'between:0,250',
            'calendario' => 'between:0,200',
            'comentario'=> 'between:0,500',
        ]);

        HorarioMateriaDocente::create($data);
        return redirect()->route('horaroDocente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HorarioMateriaDocente  $horarioMateriaDocente
     * @return \Illuminate\Http\Response
     */
    public function show(HorarioMateriaDocente $horarioMateriaDocente)
    {
        return view('horaroDocente.show',compact('horarioMateriaDocente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HorarioMateriaDocente  $horarioMateriaDocente
     * @return \Illuminate\Http\Response
     */
    public function edit(HorarioMateriaDocente $horarioMateriaDocente)
    {
        return view('horaroDocente.edit',compact('horarioMateriaDocente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HorarioMateriaDocente  $horarioMateriaDocente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HorarioMateriaDocente $horarioMateriaDocente)
    {
        $data = request()->all();
        $data = request()->validate([
            'crn' => 'required|between:5,8|exists:crn,crn',
            'descripcion' => 'required|between:1,250',
            'id_docente' => 'required|between:8,10|exists:docentes,id_banner',
            'dia' => 'required|integer|between:1,7',
            'fecha_vig_ini' => 'required|date_format:Y-m-d|before_or_equal:' . $data['fecha_vig_fin'],
            'fecha_vig_fin' => 'required|date_format:Y-m-d',
            'hora_ini' => 'required|date_format:H:i:s|before_or_equal:' . $data['hora_fin'],
            'hora_fin' => 'required|date_format:H:i:s',
            'grupo' => 'between:0,250',
            'calendario' => 'between:0,200',
            'comentario'=> 'between:0,500',
        ]);

        $horarioMateriaDocente->update($data);
        return redirect()->route('horaroDocente.show',$horarioMateriaDocente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HorarioMateriaDocente  $horarioMateriaDocente
     * @return \Illuminate\Http\Response
     */
    public function destroy(HorarioMateriaDocente $horarioMateriaDocente)
    {
        $horarioMateriaDocente->delete();
        return redirect()->route('horaroDocente.index');
    }
}
