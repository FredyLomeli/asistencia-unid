<?php

namespace App\Http\Controllers;

use App\ToquesPromocion;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToquesPromocionController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaToquesPromocion')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaToquesPromocion')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $toques_promocion = ToquesPromocion::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('toques_promocion.index', compact('toques_promocion', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('toques_promocion.create');
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
            'periodos_id'       => 'required|integer|exists:periodos,id',
            'citas_generadas'   => 'required|integer',
            'citas_atendidas'   => 'required|integer',
            'llamadas'          => 'required|integer',
            'fichas'            => 'required|integer',
            'avanzados'         => 'required|integer',
            'inscritos'         => 'required|integer',
            'comision'          => 'nullable|integer|between:0,1', // 1 comision, 0 trabajo en oficina
            'estado'            => 'required|integer|between:0,1', // 1 Activo, 0 Cancelado
            'comentario'        => 'nullable|string|max:500',
            'adicional1'        => 'nullable|string|max:255',
            'adicional2'        => 'nullable|string|max:255',
            'adicional3'        => 'nullable|string|max:255',
            'adicional4'        => 'nullable|string|max:255',
        ]);
        $data['users_id'] = Auth()->user()->id;
        ToquesPromocion::create($data);
        return redirect()->route('toques_promocion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ToquesPromocion  $toques_promocion
     * @return \Illuminate\Http\ToquesPromocion
     */
    public function show(ToquesPromocion $toques_promocion)
    {
        return view('toques_promocion.show', compact('toques_promocion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ToquesPromocion  $toques_promocion
     * @return \Illuminate\Http\Response
     */
    public function edit(ToquesPromocion $toques_promocion)
    {
        return view('toques_promocion.edit', compact('toques_promocion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ToquesPromocion  $toques_promocion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToquesPromocion $toques_promocion)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $toques_promocion->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $toques_promocion->update($data);
        return redirect()->route('toques_promocion.show', $toques_promocion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ToquesPromocion  $toques_promocion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToquesPromocion $toques_promocion)
    {
        $toques_promocion->delete();
        return redirect()->route('toques_promocion.index');
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
