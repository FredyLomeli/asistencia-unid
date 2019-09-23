<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Clases\ReportClass;


class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDocente()
    {
        $docentes = DB::select('SELECT id_banner, CONCAT(id_banner, \' - \',nombre, \' \', apellido_paterno, \' \', apellido_materno) AS docente FROM docentes WHERE estatus = 1');
        return view('reporteDocente.index',compact('docentes'));
    }

    public function generarReporteDocente(Request $request){
        $data = $request->all();
        $data = request()->validate([
            'tipo' => 'required|integer|between:0,2',
            'hoja' => '',
            'id_docentes' => 'exists:docentes,id_banner',
            'id_docentes*' => 'between:8,10|exists:docentes,id_banner',
            'fecha_inicial' => 'required|date_format:Y-m-d|before_or_equal:' . $data['fecha_final'],
            'fecha_final' => 'required|date_format:Y-m-d',
        ]);
        $CReport = new ReportClass();
        $data['tipoNombre'] = $CReport->tipoDeReporte($data['tipo']);
        if(!isset($data['id_docentes']))
            $data['id_docentes'] = $CReport->verificarDocentesActivos($data['fecha_inicial'],$data['fecha_final']);
        if(!isset($data['hoja']))
            $data['tipo'] += 2;
        $data['id_docentes_total'] = $CReport->listarIdDocentes($data['id_docentes']);
        return view('reporteDocente.generar', compact('data'));
    }

    public function view(){
        return view('pdf.test');
    }

    // Crea el PDF indicando el objeto y formato
    public function viewPdf($tipo,$fecha_inicial,$fecha_final,$id_docentes){
        $id_docentes = explode(',', $id_docentes);
        $CReport = new ReportClass();
        $pdf = null;
        switch ($tipo) {
            case 0:
                $pdf = $CReport->generarReporteChecadas('pdf.checadas',$fecha_inicial,$fecha_final,$id_docentes,1);
                break;
            case 1:
                $pdf = $CReport->generarReporteHoras('pdf.horas',$fecha_inicial,$fecha_final,$id_docentes,1);
                break;
            case 2:
                $pdf = $CReport->generarReporteChecadas('pdf.checadas-list',$fecha_inicial,$fecha_final,$id_docentes,1);
                break;
            case 3:
                $pdf = $CReport->generarReporteHoras('pdf.horas-list',$fecha_inicial,$fecha_final,$id_docentes,1);
                break;
            default:
                # code...
                break;
        }
        return $pdf->stream();
    }

    // Crea el PDF indicando el objeto y formato
    public function downloadExcel($tipo,$fecha_inicial,$fecha_final,$id_docentes){
        $id_docentes = explode(',', $id_docentes);
        $CReport = new ReportClass();
        $excel = null;
        switch ($tipo) {
            case 0:
                $excel = $CReport->generarReporteChecadas('pdf.checadas-list',$fecha_inicial,$fecha_final,$id_docentes,2);
                break;
            case 1:
                $excel = $CReport->generarReporteHoras('pdf.horas-list',$fecha_inicial,$fecha_final,$id_docentes,2);
                break;
            case 2:
                $excel = $CReport->generarReporteChecadas('pdf.checadas-list',$fecha_inicial,$fecha_final,$id_docentes,2);
                break;
            case 3:
                $excel = $CReport->generarReporteHoras('pdf.horas-list',$fecha_inicial,$fecha_final,$id_docentes,2);
                break;
            default:
                # code...
                break;
        }
        $excel->download('xlsx');
    }


}
