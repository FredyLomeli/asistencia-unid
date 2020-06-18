<?php

namespace App\Http\Controllers;

use App\Programas;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramasController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaProgramas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaProgramas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $programas = Programas::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('programas.index', compact('programas', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programas.create');
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
            'lineas_negocio_id' => 'required|integer|exists:lineas_negocios,id',
            'descripcion'       => 'required|string|max:255',
            'abreviatura'       => 'required|string|max:10',
            'comentario'        => 'nullable|string|max:500',
            'adicional1'        => 'nullable|string|max:255',
            'adicional2'        => 'nullable|string|max:255',
            'adicional3'        => 'nullable|string|max:255',
            'adicional4'        => 'nullable|string|max:255',
        ]);

        Programas::create($data);
        return redirect()->route('programas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programas  $programas
     * @return \Illuminate\Http\Programas
     */
    public function show(Programas $programas)
    {
        return view('programas.show', compact('programas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function edit(Programas $programas)
    {
        return view('programas.edit', compact('programas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programas $programas)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $programas->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $programas->update($data);
        return redirect()->route('programas.show', $programas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programas $programas)
    {
        $programas->delete();
        return redirect()->route('programas.index');
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
