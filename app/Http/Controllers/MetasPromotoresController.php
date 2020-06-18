<?php

namespace App\Http\Controllers;

use App\MetasPromotores;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MetasPromotoresController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaMetasPromotores')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaMetasPromotores')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $metas_promotores = MetasPromotores::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('metas_promotores.index', compact('metas_promotores', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metas_promotores.create');
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
            'users_id'      => 'required|integer|exist:users,id',
            'periodos_id'   => 'required|intefer|exist:periodos,id',
            'catidad'       => 'required|integer',
            'comentario'    => 'nullable|string|max:500',
            'adicional1'    => 'nullable|string|max:255',
            'adicional2'    => 'nullable|string|max:255',
            'adicional3'    => 'nullable|string|max:255',
            'adicional4'    => 'nullable|string|max:255',
        ]);

        MetasPromotores::create($data);
        return redirect()->route('metas_promotores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MetasPromotores  $metas_promotores
     * @return \Illuminate\Http\MetasPromotores
     */
    public function show(MetasPromotores $metas_promotores)
    {
        return view('metas_promotores.show', compact('metas_promotores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MetasPromotores  $metas_promotores
     * @return \Illuminate\Http\Response
     */
    public function edit(MetasPromotores $metas_promotores)
    {
        return view('metas_promotores.edit', compact('metas_promotores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MetasPromotores  $metas_promotores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetasPromotores $metas_promotores)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $metas_promotores->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $metas_promotores->update($data);
        return redirect()->route('metas_promotores.show', $metas_promotores);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MetasPromotores  $metas_promotores
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetasPromotores $metas_promotores)
    {
        $metas_promotores->delete();
        return redirect()->route('metas_promotores.index');
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
