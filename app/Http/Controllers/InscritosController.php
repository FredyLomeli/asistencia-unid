<?php

namespace App\Http\Controllers;

use App\Inscritos;
use App\Configuraciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InscritosController extends Controller
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

        $cabeceras = Configuraciones::where('config', 'NombreCamposTablaInscritos')
            ->where('users_id',Auth()->user()->id)->value('value');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuraciones::where('config', 'CamposTablaInscritos')
            ->where('users_id',Auth()->user()->id)->value('value');
        $campos = explode(',', $campos);
        $campos[] = 'id';
        $inscritos = Inscritos::select($campos)
            ->orderBy('id', 'DESC')
            ->busqueda($filtro)
            ->paginate($registros);
        return view('inscritos.index', compact('inscritos', 'campos', 'cabeceras', 'filtro', 'registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inscritos.create');
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
            'id_banner'         => 'nullable|between:8,10|unique:inscritos,id_banner',
            'empresas_id'       => 'required|integer|exists:empresas,id',
            'escuelas_id'       => 'required|integer|exists:escuelas,id',
            'beca'              => 'required|integer|between:0,100',
            'descuento'         => 'required|integer|between:0,100',
            'lineas_negocio_id' => 'required|integer|exists:lineas_negocios,id',
            'programas_id'      => 'required|integer|exists:programas,id',
            'periodos_id'       => 'required|integer|exists:periodos,id',
            'forma_cobro'       => 'required|integer|between:0,4', //1 efectivo, 2 Credito, 3 Transferencia
            'inscripcion'       => 'required|numeric',
            'mensualidad'       => 'required|numeric',
            'tarjeta_digitos'   => 'nullable|string|max:255',
            'estado'            => 'required|integer|between:0,1', //1 inscrito, 0 Baja
            'beca_banner'       => 'required|integer|between:0,100',
            'descuento_banner'  => 'required|integer|between:0,100',
            'beca_dev'          => 'required|integer|between:0,100',
            'descuento_dev'     => 'required|integer|between:0,100',
            'motivo_beca'       => 'required|integer|between:0,100',
            'comentario'        => 'nullable|string|max:500',
            'adicional1'        => 'nullable|string|max:255',
            'adicional2'        => 'nullable|string|max:255',
            'adicional3'        => 'nullable|string|max:255',
            'adicional4'        => 'nullable|string|max:255',
        ]);
        $data['users_id'] = Auth()->user()->id;
        Inscritos::create($data);
        return redirect()->route('inscritos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inscritos  $inscritos
     * @return \Illuminate\Http\Inscritos
     */
    public function show(Inscritos $inscritos)
    {
        return view('inscritos.show', compact('inscritos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inscritos  $inscritos
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscritos $inscritos)
    {
        return view('inscritos.edit', compact('inscritos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscritos  $inscritos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscritos $inscritos)
    {
        $data = request()->validate([
            'id_banner' => 'required|between:8,10|unique:docentes,id_banner,' . $inscritos->id,
            'nombre' => 'required|between:0,100',
            'apellido_paterno' => 'required|between:0,100',
            'apellido_materno' => 'between:0,100',
            'estatus' => 'required|integer|between:0,1',
            'comentario' => 'between:0,500',
        ]);

        $inscritos->update($data);
        return redirect()->route('inscritos.show', $inscritos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inscritos  $inscritos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscritos $inscritos)
    {
        $inscritos->delete();
        return redirect()->route('inscritos.index');
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
