<?php

namespace App\Http\Controllers;

use App\Periodos;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodosController extends Controller
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

        if (!$registros) $registros = 15;

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaPeriodos')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaPeriodos')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $periodos = Periodos::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('periodos.index', compact('periodos', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periodos.create');
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
            'descripcion'               => 'required|string|max:50',
            'periodo'                   => 'required|string|max:10',
            'meta_general'              => 'required|integer',
            'fecha_inicio'              => 'required|date_format:Y-m-d H:i:s',
            'fecha_fin'                 => 'required|date_format:Y-m-d H:i:s',
            'costo_inscripcion_lic'     => 'required|numeric',
            'costo_mensualidad_lic'     => 'required|numeric',
            'costo_inscripcion_eje'     => 'required|numeric',
            'costo_mensualidad_eje'     => 'required|numeric',
            'costo_mensualidad_mae'     => 'required|numeric',
            'costo_mensualidad_mae_edu' => 'required|numeric',
            'estado'                    => 'required|integer|between:0,2', //0 cancelado, 1 Activo, 2 Cerrado
            'comentario'                => 'nullable|string|max:500',
            'adicional1'                => 'nullable|string|max:255',
            'adicional2'                => 'nullable|string|max:255',
            'adicional3'                => 'nullable|string|max:255',
            'adicional4'                => 'nullable|string|max:255',
        ]);

        Periodos::create($data);
        return redirect()->route('periodos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periodos  $periodos
     * @return \Illuminate\Http\Periodos
     */
    public function show(Periodos $periodos)
    {
        return view('periodos.show', compact('periodos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Periodos  $periodos
     * @return \Illuminate\Http\Response
     */
    public function edit(Periodos $periodos)
    {
        return view('periodos.edit', compact('periodos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periodos  $periodos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periodos $periodos)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $periodos->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $periodos->update($data);
        return redirect()->route('periodos.show', $periodos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periodos  $periodos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodos $periodos)
    {
        $periodos->delete();
        return redirect()->route('periodos.index');
    }

    function autocomplete(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            // $data = Docente::where('CONCAT(id_banner, \' \',nombre, \' \', apellido_paterno, \' \', apellido_materno)', 'LIKE', "%{$query}%")->get();
            $data = DB::select('select CONCAT(id_banner, \' - \',nombre, \' \', apellido_paterno, \' \', apellido_materno) as docente from docentes where CONCAT(id_banner, \' \',nombre, \' \', apellido_paterno, \' \', apellido_materno) LIKE "%'.$query.'%" ');
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="doc"><a href="#">' . $row->docente . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
