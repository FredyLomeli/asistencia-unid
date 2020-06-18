<?php

namespace App\Http\Controllers;

use App\ToquesDesglose;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToquesDesgloseController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaToquesDesglose')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaToquesDesglose')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $toques_desglose = ToquesDesglose::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('toques_desglose.index', compact('toques_desglose', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('toques_desglose.create');
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
            'toques_promo_id'   => 'required|integer|exist:toques_promocions,id',
            'lineas_negocio_id' => 'required|integer|exists:lineas_negocios,id',
            'cantidad'          => 'required|integer',
            'tipo_movimiento'   => 'required|integer|between:0,4', //1 fichas, 2 avanzados, 3 citas generadas, 4 citas atendidas
            'comentario'        => 'nullable|string|max:500',
            'adicional1'        => 'nullable|string|max:255',
            'adicional2'        => 'nullable|string|max:255',
            'adicional3'        => 'nullable|string|max:255',
            'adicional4'        => 'nullable|string|max:255',
        ]);

        ToquesDesglose::create($data);
        return redirect()->route('toques_desglose.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ToquesDesglose  $toques_desglose
     * @return \Illuminate\Http\ToquesDesglose
     */
    public function show(ToquesDesglose $toques_desglose)
    {
        return view('toques_desglose.show', compact('toques_desglose'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ToquesDesglose  $toques_desglose
     * @return \Illuminate\Http\Response
     */
    public function edit(ToquesDesglose $toques_desglose)
    {
        return view('toques_desglose.edit', compact('toques_desglose'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ToquesDesglose  $toques_desglose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToquesDesglose $toques_desglose)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $toques_desglose->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $toques_desglose->update($data);
        return redirect()->route('toques_desglose.show', $toques_desglose);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ToquesDesglose  $toques_desglose
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToquesDesglose $toques_desglose)
    {
        $toques_desglose->delete();
        return redirect()->route('toques_desglose.index');
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
