<?php

namespace App\Http\Controllers;

use App\CapturaPapeletas;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CapturaPapeletasController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaCapturaPapeletas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaCapturaPapeletas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $captura_papeletas = CapturaPapeletas::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('captura_papeletas.index', compact('captura_papeletas', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('captura_papeletas.create');
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
            'lineas_negcio_id'  => 'required|integer|exists:lineas_negocios,id',
            'escuelas_id'       => 'required|integer|exists:escuelas,id',
            'empresas_id'       => 'required|integer|exists:empresas,id',
            'cantidad'          => 'required|integer',
            'comentario'        => 'nullable|max:500',
            'adicional1'        => 'nullable|max:255',
            'adicional2'        => 'nullable|max:255',
            'adicional3'        => 'nullable|max:255',
            'adicional4'        => 'nullable|max:255',
        ]);
        $data['users_id'] = Auth()->user()->id;
        CapturaPapeletas::create($data);
        return redirect()->route('captura_papeletas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CapturaPapeletas  $captura_papeletas
     * @return \Illuminate\Http\CapturaPapeletas
     */
    public function show(CapturaPapeletas $captura_papeletas)
    {
        return view('captura_papeletas.show', compact('captura_papeletas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CapturaPapeletas  $captura_papeletas
     * @return \Illuminate\Http\Response
     */
    public function edit(CapturaPapeletas $captura_papeletas)
    {
        return view('captura_papeletas.edit', compact('captura_papeletas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CapturaPapeletas  $captura_papeletas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CapturaPapeletas $captura_papeletas)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $captura_papeletas->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $captura_papeletas->update($data);
        return redirect()->route('captura_papeletas.show', $captura_papeletas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CapturaPapeletas  $captura_papeletas
     * @return \Illuminate\Http\Response
     */
    public function destroy(CapturaPapeletas $captura_papeletas)
    {
        $captura_papeletas->delete();
        return redirect()->route('captura_papeletas.index');
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
