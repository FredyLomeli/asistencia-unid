<?php
// Tipo 0 Bloqueo Docentes
// Tipo 1 Bloqueo CRN
// Tipo 2 Bloqueo Contraseña
// Tipo 3 Contraseña
// Tipo 4 Calendario
// Tipo 5 Asueto
// Tipo 6 NombreCampos de Tablas
// Tipo 7 Campos de Tablas
// Tipo 8 TamañoCampos de Tablas
// Tipo 9 NombreCamposFiltro de Tablas
// Tipo 10 CamposFiltro de Tablas
// Tipo 11 Limite de registros por tabla

namespace App\Http\Controllers;

use App\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
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

        $configuraciones = Configuracion::orderBy('id','DESC')
        ->busqueda($filtro)
        ->paginate($registros);
        return view('config.index',compact('configuraciones','filtro','registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('config.create');
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
            'tipo' => 'required|integer|between:0,11',
            'fec_ini' => '',
            'fec_fin' => '',
            'nombre' => '',
            'datos' => '',
            'fecha' => '',
        ]);
        switch ($data['tipo']) {
            case "4":
            $data = request()->validate([
                'fec_ini' => 'required|between:8,250|date_format:d/m/Y|before_or_equal:' . $data['fec_fin'],
                'fec_fin' => 'required|between:8,250|date_format:d/m/Y',
                'nombre' => 'required|between:1,250|unique:configuracion,nombre',
                'tipo' => 'required|integer|between:0,11',
            ]);
            $data['datos'] = $data['fec_ini'] . " | " . $data['fec_fin'];
                break;
            case "5":
            $data = request()->validate([
                'fecha' => 'required|between:8,250|date_format:d/m/Y',
                'nombre' => 'required|between:1,250|unique:configuracion,nombre',
                'tipo' => 'required|integer|between:0,11',
            ]);
            $data['datos'] = $data['fecha'];
                break;
            default:
            $data = request()->validate([
                'nombre' => 'required|between:1,250|unique:configuracion,nombre',
                'datos' => 'required|between:1,250',
                'tipo' => 'required|integer|between:0,11',
            ]);
                break;
        }
        Configuracion::create($data);
        return redirect()->route('config.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function show(Configuracion $configuracion)
    {
        switch ($configuracion->tipo) {
            case "4":
            $fechas = explode('|', $configuracion->datos);
            $configuracion->fec_ini = $fechas[0];
            $configuracion->fec_fin = $fechas[1];
            $configuracion->datos = "";
                break;
            case "5":
            $configuracion->fecha = $configuracion->datos;
            $configuracion->datos = "";
                break;
            default:
                break;
        }
        return view('config.show',compact('configuracion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuracion $configuracion)
    {
        switch ($configuracion->tipo) {
            case "4":
            $fechas = explode('|', $configuracion->datos);
            $configuracion->fec_ini = $fechas[0];
            $configuracion->fec_fin = $fechas[1];
            $configuracion->datos = "";
                break;
            case "5":
            $configuracion->fecha = $configuracion->datos;
            $configuracion->datos = "";
                break;
            default:
                break;
        }
        return view('config.edit',compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuracion $configuracion)
    {
        $data = request()->validate([
            'tipo' => 'required|integer|between:0,11',
            'fec_ini' => '',
            'fec_fin' => '',
            'nombre' => '',
            'datos' => '',
            'fecha' => '',
        ]);
        switch ($data['tipo']) {
            case "4":
            $data = request()->validate([
                'fec_ini' => 'required|between:8,250|date_format:d/m/Y|before_or_equal:' . $data['fec_fin'],
                'fec_fin' => 'required|between:8,250|date_format:d/m/Y',
                'nombre' => 'required|between:1,250|unique:configuracion,nombre,'.$configuracion->id,
                'tipo' => 'required|integer|between:0,11',
            ]);
            $data['datos'] = $data['fec_ini'] . " | " . $data['fec_fin'];
                break;
            case "5":
            $data = request()->validate([
                'fecha' => 'required|between:8,250|date_format:d/m/Y',
                'nombre' => 'required|between:1,250|unique:configuracion,nombre,'.$configuracion->id,
                'tipo' => 'required|integer|between:0,11',
            ]);
            $data['datos'] = $data['fecha'];
                break;
            default:
            $data = request()->validate([
                'nombre' => 'required|between:1,250|unique:configuracion,nombre,'.$configuracion->id,
                'datos' => 'required|between:1,250',
                'tipo' => 'required|integer|between:0,11',
            ]);
                break;
        }
        $configuracion->update($data);
        return redirect()->route('config.show',$configuracion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuracion $configuracion)
    {
        $configuracion->delete();
        return redirect()->route('config.index');
    }

}
