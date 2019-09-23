<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ChecadasExport implements FromView
{
    public $vista;
    public $config;
    public $docentes;
    public $registros;

    use Exportable;

    public function __construct($vista,$config,$docentes,$registros){
        $this->vista = $vista;
        $this->config = $config;
        $this->docentes = $docentes;
        $this->registros = $registros;
    }

    public function view(): View
    {
        $vista = $this->vista;
        $config = $this->config;
        $docentes = $this->docentes;
        $registros = $this->registros;
        return view($vista,compact('config','docentes','registros'));
    }
}
