<?php

namespace App\Http\Controllers;

use App\LineasNegocio;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LineasNegocioController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaLineasNegocio')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaLineasNegocio')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $lineas_negocio = LineasNegocio::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('lineas_negocio.index', compact('lineas_negocio', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lineas_negocio.create');
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
            'descripcion'   => 'required|string|max:255',
            'abreviatura'   => 'required|string|max:5',
            'comentario'    => 'nullable|string|max:500',
            'adicional1'    => 'nullable|string|max:255',
            'adicional2'    => 'nullable|string|max:255',
            'adicional3'    => 'nullable|string|max:255',
            'adicional4'    => 'nullable|string|max:255',
        ]);

        LineasNegocio::create($data);
        return redirect()->route('lineas_negocio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LineasNegocio  $lineas_negocio
     * @return \Illuminate\Http\LineasNegocio
     */
    public function show(LineasNegocio $lineas_negocio)
    {
        return view('lineas_negocio.show', compact('lineas_negocio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LineasNegocio  $lineas_negocio
     * @return \Illuminate\Http\Response
     */
    public function edit(LineasNegocio $lineas_negocio)
    {
        return view('lineas_negocio.edit', compact('lineas_negocio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LineasNegocio  $lineas_negocio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LineasNegocio $lineas_negocio)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $lineas_negocio->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $lineas_negocio->update($data);
        return redirect()->route('lineas_negocio.show', $lineas_negocio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LineasNegocio  $lineas_negocio
     * @return \Illuminate\Http\Response
     */
    public function destroy(LineasNegocio $lineas_negocio)
    {
        $lineas_negocio->delete();
        return redirect()->route('lineas_negocio.index');
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
