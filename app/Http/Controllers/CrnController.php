<?php

namespace App\Http\Controllers;

use App\Crn;
use App\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrnController extends Controller
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

        if(!$registros) $registros = 15;

        $cabeceras = Configuracion::where('nombre','NombreCamposTablaCrn')
            ->where('tipo', 6)->value('datos');
        $cabeceras = explode(',', $cabeceras);
        $campos = Configuracion::where('nombre','CamposTablaCrn')
            ->where('tipo', 7)->value('datos');
        $campos = explode(',', $campos);
        $crns = Crn::select($campos)
        ->orderBy('id','DESC')
        ->busqueda($filtro)
        ->paginate($registros);
        return view('crn.index',compact('crns','campos','cabeceras','filtro','registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crn.create');
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
            'crn' => 'required|between:5,8|unique:crn,crn',
            'nombre' => 'required|between:0,254',
            'estado' => 'required|integer|between:0,1',
        ]);

        Crn::create($data);
        return redirect()->route('crn.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Crn  $crn
     * @return \Illuminate\Http\Response
     */
    public function show(Crn $crn)
    {
        return view('crn.show',compact('crn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Crn  $crn
     * @return \Illuminate\Http\Response
     */
    public function edit(Crn $crn)
    {
        return view('crn.edit',compact('crn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Crn  $crn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crn $crn)
    {
        $data = request()->validate([
            'crn' => 'required|between:5,8|unique:crn,crn,'.$crn->id,
            'nombre' => 'required|between:0,254',
            'estado' => 'required|integer|between:0,1',
        ]);

        $crn->update($data);
        return redirect()->route('crn.show',$crn);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Crn  $crn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crn $crn)
    {
        $crn->delete();
        return redirect()->route('crn.index');
    }

    function autocomplete(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::select('select CONCAT(crn, \' - \',nombre) as materia from crn where CONCAT(crn, \' \',nombre) LIKE "%'.$query.'%" ');
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="mat"><a href="#">' . $row->materia . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
