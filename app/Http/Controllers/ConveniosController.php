<?php

namespace App\Http\Controllers;

use App\Convenios;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConveniosController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaConvenios')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaConvenios')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $convenios = Convenios::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('convenios.index', compact('convenios', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('convenios.create');
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
            'empresas_id'               => 'required|integer|exists:empresas,id',
            'escuelas_id'               => 'required|integer|exists:escuelas,id',
            'conv_promo'                => 'required|integer|between:0,1',
            'descripcion_conv_promo'    => 'nullable|string|max:500',
            'conv_servicio'             => 'required|integer|between:0,1',
            'descripcion_conv_servicio' => 'nullable|string|max:500',
            'conv_estadia'              => 'required|integer|between:0,1',
            'descripcion_conv_estadia'  => 'nullable|string|max:500',
            'fecha_conv'                => 'required|date_format:Y-m-d H:i:s',
            'vigencia_conv'             => 'required|date_format:Y-m-d H:i:s',
            'nombre_representante'      => 'required|string|max:255',
            'cargo_representante'       => 'required|string|max:255',
            'correo_representante'      => 'nullable|string|max:255',
            'telefono_representante'    => 'nullable|string|max:255',
            'comentario'                => 'nullable|max:500',
            'adicional1'                => 'nullable|max:255',
            'adicional2'                => 'nullable|max:255',
            'adicional3'                => 'nullable|max:255',
            'adicional4'                => 'nullable|max:255',
        ]);
        $data['users_id'] = Auth()->user()->id;
        Convenios::create($data);
        return redirect()->route('convenios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Convenios  $convenios
     * @return \Illuminate\Http\Convenios
     */
    public function show(Convenios $convenios)
    {
        return view('convenios.show', compact('convenios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Convenios  $convenios
     * @return \Illuminate\Http\Response
     */
    public function edit(Convenios $convenios)
    {
        return view('convenios.edit', compact('convenios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Convenios  $convenios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Convenios $convenios)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $convenios->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $convenios->update($data);
        return redirect()->route('convenios.show', $convenios);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Convenios  $convenios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Convenios $convenios)
    {
        $convenios->delete();
        return redirect()->route('convenios.index');
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
