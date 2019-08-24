<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $cabeceras = Configuracion::where('nombre',)
            ->where('tipo', 6)->value('datos');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuracion::where('nombre','CamposTablaMaterias')
            ->where('tipo', 7)->value('datos');
        $campos = explode(',', $campos);
        $horarioMateriaDocente = HorarioMateriaDocente::orderBy('id','DESC')
        ->busqueda($filtro)
        ->paginate($registros);
        return view('horarioDocente.index',compact('horarioMateriaDocente','campos','cabeceras','filtro','registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $calendarios = Configuracion::orderBy('id','DESC')->where('tipo',4)->get();
        $calendarioActual = $calendarios->first();
        $fechas = explode(' | ', $calendarioActual->datos);
        $calendarioActual->fechaInicio = Carbon::createFromFormat('d/m/Y', $fechas[0])->format('Y-m-d');
        $calendarioActual->fechaFin = Carbon::createFromFormat('d/m/Y', $fechas[1])->format('Y-m-d');
        return view('horarioDocente.create',compact('calendarios', 'calendarioActual'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data = request()->validate([
            'crn' => 'required|between:5,8|exists:crn,crn',
            'descripcion' => 'required|between:1,250',
            'id_docente' => 'required|between:8,10|exists:docentes,id_banner',
            'dia' => 'required|integer|between:0,6',
            'fecha_vig_ini' => 'required|date_format:Y-m-d|before_or_equal:' . $data['fecha_vig_fin'],
            'fecha_vig_fin' => 'required|date_format:Y-m-d',
            'hora_ini' => 'required|date_format:H:i:s|before_or_equal:' . $data['hora_fin'],
            'hora_fin' => 'required|date_format:H:i:s',
            'grupo' => 'between:0,250',
            'calendario' => 'between:0,200',
            'comentario'=> 'between:0,500',
        ]);
        $arrayCalendar = explode('|', $data['calendario']);
        $data['calendario'] = $arrayCalendar[0];

        HorarioMateriaDocente::create($data);
        return redirect()->route('horarioDocente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HorarioMateriaDocente  $horarioMateriaDocente
     * @return \Illuminate\Http\Response
     */
    public function show(HorarioMateriaDocente $horarioMateriaDocente)
    {
        return view('horarioDocente.show',compact('horarioMateriaDocente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HorarioMateriaDocente  $horarioMateriaDocente
     * @return \Illuminate\Http\Response
     */
    public function edit(HorarioMateriaDocente $horarioMateriaDocente)
    {
        $calendarios = Configuracion::orderBy('id','DESC')->where('tipo',4)->get();
        return view('horarioDocente.edit',compact('horarioMateriaDocente', 'calendarios'));
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
        $data = $request->all();
        $data = request()->validate([
            'crn' => 'required|between:5,8|exists:crn,crn',
            'descripcion' => 'required|between:1,250',
            'id_docente' => 'required|between:8,10|exists:docentes,id_banner',
            'dia' => 'required|integer|between:0,6',
            'fecha_vig_ini' => 'required|date_format:Y-m-d|before_or_equal:' . $data['fecha_vig_fin'],
            'fecha_vig_fin' => 'required|date_format:Y-m-d',
            'hora_ini' => 'required|date_format:H:i:s|before_or_equal:' . $data['hora_fin'],
            'hora_fin' => 'required|date_format:H:i:s',
            'grupo' => 'between:0,250',
            'calendario' => 'between:0,200',
            'comentario'=> 'between:0,500',
        ]);
        $arrayCalendar = explode('|', $data['calendario']);
        $data['calendario'] = $arrayCalendar[0];

        $horarioMateriaDocente->update($data);
        return redirect()->route('horarioDocente.show',$horarioMateriaDocente);
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
        return redirect()->route('horarioDocente.index');
    }
}
