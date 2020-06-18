<?php

namespace App\Http\Controllers;

use App\Prospeccion;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProspeccionController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaProspeccion')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaProspeccion')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $prospeccion = Prospeccion::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('prospeccion.index', compact('prospeccion', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prospeccion.create');
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
            'comentario'        => 'nullable|string|max:500',
            'adicional1'        => 'nullable|string|max:255',
            'adicional2'        => 'nullable|string|max:255',
            'adicional3'        => 'nullable|string|max:255',
            'adicional4'        => 'nullable|string|max:255',
        ]);

        Prospeccion::create($data);
        return redirect()->route('prospeccion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prospeccion  $prospeccion
     * @return \Illuminate\Http\Prospeccion
     */
    public function show(Prospeccion $prospeccion)
    {
        return view('prospeccion.show', compact('prospeccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prospeccion  $prospeccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospeccion $prospeccion)
    {
        return view('prospeccion.edit', compact('prospeccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prospeccion  $prospeccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospeccion $prospeccion)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $prospeccion->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $prospeccion->update($data);
        return redirect()->route('prospeccion.show', $prospeccion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prospeccion  $prospeccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prospeccion $prospeccion)
    {
        $prospeccion->delete();
        return redirect()->route('prospeccion.index');
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
