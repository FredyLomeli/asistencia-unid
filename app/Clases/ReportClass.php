<?php namespace App\Clases;

use App\Docente;
use App\RegistroDocente;
use Illuminate\Support\Facades\DB;

class ReportClass
{
    public function tipoDeReporte($tipo){
        switch ($tipo) {
            case 0:
                return "Checadas";
                break;
            case 1:
                return "Horas trabajadas";
                break;
            default:
                break;
        }
    }

    public function verificarDocentesActivos($fecha_inicial,$fecha_final){
        $docentes = RegistroDocente::select('docente_banner')
        ->distinct('docente_banner')
        ->where('fecha_hora_reg','>=',$fecha_inicial.' 00:00:00')
        ->where('fecha_hora_reg','<=',$fecha_final.' 23:59:59')
        ->get();
        $id_docentes = null;
        $i = 0;
        foreach ($docentes as $docente) {
            $id_docentes[$i] = $docente->docente_banner;
            $i++;
        }
        return $id_docentes;
    }

    public function listarIdDocentes($id_docentes){
        $id_docente_total = null;
        foreach ($id_docentes as $docente) {
            if($id_docente_total == null)
            $id_docente_total = $docente;
            else $id_docente_total .= ",".$docente;
        }
        return $id_docente_total;
    }

    public function concatenarIdDocente($Ids){
        $idConcatenados="";
        foreach ($Ids as $Id) {
            $idConcatenados .= " " . $Id;
        }
        return trim($idConcatenados);
    }

    public function generarReporteChecadas($view, $fecha_inicio, $fecha_fin, $id_docentes){
        $config['tipo'] = "Checadas";
        $config['fecha_inicial'] = $fecha_inicio;
        $config['fecha_final'] = $fecha_fin;
        $docentes = Docente::whereIn('id_banner', $id_docentes)->get();
        $registros = null;
        foreach ($id_docentes as $id_docente) {
            $registro = DB::select("SELECT * FROM registro_docente WHERE docente_banner = {$id_docente} AND fecha_hora_reg >= '{$fecha_inicio} 00:00:00' AND fecha_hora_reg <= '{$fecha_fin} 23:59:59'");
            $registros[$id_docente] = $registro;
        }
        return $this->generarPDF($view,$config,$docentes,$registros);
    }

    public function generarReporteHoras($view, $fecha_inicio, $fecha_fin, $id_docentes){
        $config['tipo'] = "Horas Trabajadas";
        $config['fecha_inicial'] = $fecha_inicio;
        $config['fecha_final'] = $fecha_fin;
        $docentes = Docente::whereIn('id_banner', $id_docentes)->get();
        $registros = null;
        $i = 0;
        foreach ($docentes as $docente) {
            $sql = $this->generarConsultaEntradaSalida($docente->id_banner,$fecha_inicio,$fecha_fin);
            $registro = DB::select($sql);
            $registros[$docente->id_banner] = $registro;
            $sql = $this->generarConsultaCalculoHoras($docente->id_banner,$fecha_inicio,$fecha_fin);
            $registro = DB::select($sql);
            $docentes[$i]->horas_trabajadas = $registro[0]->trabajado;
            $i++;
        }
        return $this->generarPDF($view,$config,$docentes,$registros);
    }

    public function generarPDF($vista,$config,$docentes,$registros){
        $pdf = \PDF::loadview($vista,compact('config','docentes','registros'));
        return $pdf;

    }

    public function generarConsultaEntradaSalida($id_docente,$fecha_inicio,$fecha_fin){
        $sql = "SELECT e.docente_banner, e.crn, DATE_FORMAT(e.fecha_hora_reg,'%Y-%m-%d') AS 'fecha', ".
            "e.dia, DATE_FORMAT(e.fecha_hora_reg, '%H:%i:%s') AS 'r_entrada', ".
            "DATE_FORMAT((SELECT s.fecha_hora_reg FROM registro_docente s WHERE s.docente_banner = '{$id_docente}' ".
            "AND s.tipo_registro = 'Salida' AND s.fecha_hora_reg > e.fecha_hora_reg AND s.fecha_hora_reg <= ".
            "(CONCAT(DATE_FORMAT(e.fecha_hora_reg,'%Y-%m-%d'),' ','23:59:59')) ORDER BY s.fecha_hora_reg ASC LIMIT 1 )".
            ", '%H:%i:%s') AS 'r_salida', TIMEDIFF((SELECT s.fecha_hora_reg FROM registro_docente s ".
            "WHERE s.docente_banner = '{$id_docente}' AND s.tipo_registro = 'Salida' AND s.fecha_hora_reg ".
            " > e.fecha_hora_reg AND s.fecha_hora_reg <= (CONCAT(DATE_FORMAT(e.fecha_hora_reg,'%Y-%m-%d')".
            ",' ','23:59:59')) ORDER BY s.fecha_hora_reg ASC LIMIT 1 ), e.fecha_hora_reg) AS 'trabajado' ".
            "FROM registro_docente e WHERE e.docente_banner = '{$id_docente}' AND e.tipo_registro = 'Entrada'".
            " AND e.fecha_hora_reg >= '{$fecha_inicio} 00:00:00' AND e.fecha_hora_reg <= '{$fecha_fin} 23:59:59'".
            " ORDER BY e.fecha_hora_reg ASC";
        return $sql;
    }

    public function generarConsultaCalculoHoras($id_docente,$fecha_inicio,$fecha_fin){
        $sql = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF((SELECT s.fecha_hora_reg FROM registro_docente s ".
            "WHERE s.docente_banner = '{$id_docente}' AND s.tipo_registro = 'Salida' AND s.fecha_hora_reg > ".
            "e.fecha_hora_reg AND s.fecha_hora_reg <= (CONCAT(DATE_FORMAT(e.fecha_hora_reg,'%Y-%m-%d'),' ".
            "','23:59:59')) ORDER BY s.fecha_hora_reg ASC LIMIT 1 ),e.fecha_hora_reg)))) AS 'trabajado' ".
            "FROM registro_docente e WHERE e.docente_banner = '{$id_docente}' AND e.tipo_registro = 'Entrada' ".
            "AND e.fecha_hora_reg >= '{$fecha_inicio} 00:00:00' AND e.fecha_hora_reg <= '{$fecha_fin} 23:59:59'";
        return $sql;
    }
}
