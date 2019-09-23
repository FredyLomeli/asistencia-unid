<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ChecadasExport implements FromView
{
    public $config;
    public $docentes;
    public $registros;

    public function __construct($config,$docentes,$registros){
        $this->config = $config;
        $this->docentes = $docentes;
        $this->registros = $registros;
    }

    public function view(): View
    {
        $config = $this->config;
        $docentes = $this->docentes;
        $registros = $this->registros;
        return view('pdf.checadas-list',compact('config','docentes','registros'));
    }
}
