<?php

namespace App\Http\Controllers;

use App\Empresas;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresasController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaEmpresas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaEmpresas')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $empresas = Empresas::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('empresas.index', compact('empresas', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
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
            'nombre'             => 'required|string|max:255',
            'razon_social'       => 'required|string|max:255',
            'rfc'                => 'nullable|string|max:13',
            'contacto'           => 'nullable|string|max:255',
            'celular'            => 'nullable|string|max:50',
            'telefono'           => 'nullable|string|max:50',
            'perfil_promo'       => 'nullable|string|max:3',
            'sector_promo'       => 'nullable|string|max:10',
            'alcanze_geo_promo'  => 'nullable|string|max:30',
            'programa_meta_promo'=> 'nullable|string|max:100',
            'giro_vinc'          => 'nullable|string|max:255',
            'covertura_vinc'     => 'nullable|string|max:100',
            'tipo_vinc'          => 'nullable|string|max:255',
            'domicilio'          => 'nullable|string|max:255',
            'colonia'            => 'nullable|string|max:255',
            'municipio'          => 'nullable|string|max:255',
            'codigo_postal'      => 'nullable|string|max:10',
            'estado'             => 'nullable|string|max:255',
            'comentario'         => 'nullable|string|max:500',
            'adicional1'         => 'nullable|string|max:255',
            'adicional2'         => 'nullable|string|max:255',
            'adicional3'         => 'nullable|string|max:255',
            'adicional4'         => 'nullable|string|max:255',
        ]);
        $data['users_id'] = Auth()->user()->id;
        Empresas::create($data);
        return redirect()->route('empresas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Empresas
     */
    public function show(Empresas $empresas)
    {
        return view('empresas.show', compact('empresas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresas $empresas)
    {
        return view('empresas.edit', compact('empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresas $empresas)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $empresas->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $empresas->update($data);
        return redirect()->route('empresas.show', $empresas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresas $empresas)
    {
        $empresas->delete();
        return redirect()->route('empresas.index');
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
