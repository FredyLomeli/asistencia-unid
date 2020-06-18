<?php

namespace App\Http\Controllers;

use App\Escuelas;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscuelasController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaEscuelas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaEscuelas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $escuelas = Escuelas::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('escuelas.index', compact('escuelas', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('escuelas.create');
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
            'nombre'            => 'required|string|max:255',
            'clave_cct'         => 'nullable|string|max:20',
            'tipificacion_promo'=> 'nullable|string|max:3',
            'contacto'          => 'nullable|string|max:255',
            'celular'           => 'nullable|string|max:50',
            'telefono'          => 'nullable|string|max:50',
            'tipo_escuela'      => 'required|integer|between:0,1',
            'secundaria'        => 'required|integer|between:0,1',
            'prepa'             => 'required|integer|between:0,1',
            'universidad'       => 'required|integer|between:0,1',
            'domicilio'         => 'nullable|string|max:255',
            'colonia'           => 'nullable|string|max:255',
            'municipio'         => 'nullable|string|max:255',
            'codigo_postal'     => 'nullable|string|max:255',
            'estado'            => 'nullable|string|max:255',
            'comentario'        => 'nullable|string|max:500',
            'adicional1'        => 'nullable|string|max:255',
            'adicional2'        => 'nullable|string|max:255',
            'adicional3'        => 'nullable|string|max:255',
            'adicional4'        => 'nullable|string|max:255',
        ]);
        $data['users_id'] = Auth()->user()->id;
        Escuelas::create($data);
        return redirect()->route('escuelas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Escuelas  $escuelas
     * @return \Illuminate\Http\Escuelas
     */
    public function show(Escuelas $escuelas)
    {
        return view('escuelas.show', compact('escuelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Escuelas $escuelas)
    {
        return view('escuelas.edit', compact('escuelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Escuelas $escuelas)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $escuelas->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $escuelas->update($data);
        return redirect()->route('escuelas.show', $escuelas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escuelas $escuelas)
    {
        $escuelas->delete();
        return redirect()->route('escuelas.index');
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
