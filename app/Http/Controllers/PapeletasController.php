<?php

namespace App\Http\Controllers;

use App\Papeletas;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PapeletasController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaPapeletas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaPapeletas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $papeletas = Papeletas::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('papeletas.index', compact('papeletas', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('papeletas.create');
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
            'prospeccion_id'    => 'nullable|integer',
            'toques_promo_id'   => 'nullable|integer',
            'lineas_negocio_id' => 'required|integer|exists:lineas_negocios,id',
            'cantidad'          => 'required|integer',
            'comentario'        => 'nullable|string|max:500',
            'adicional1'        => 'nullable|string|max:255',
            'adicional2'        => 'nullable|string|max:255',
            'adicional3'        => 'nullable|string|max:255',
            'adicional4'        => 'nullable|string|max:255',
        ]);
        $data['users_id'] = Auth()->user()->id;
        Papeletas::create($data);
        return redirect()->route('papeletas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Papeletas  $papeletas
     * @return \Illuminate\Http\Papeletas
     */
    public function show(Papeletas $papeletas)
    {
        return view('papeletas.show', compact('papeletas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Papeletas  $papeletas
     * @return \Illuminate\Http\Response
     */
    public function edit(Papeletas $papeletas)
    {
        return view('papeletas.edit', compact('papeletas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Papeletas  $papeletas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Papeletas $papeletas)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $papeletas->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $papeletas->update($data);
        return redirect()->route('papeletas.show', $papeletas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Papeletas  $papeletas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Papeletas $papeletas)
    {
        $papeletas->delete();
        return redirect()->route('papeletas.index');
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
