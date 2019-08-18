<?php

use App\Configuracion;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuracion::create([
            'nombre' => 'BloqueoDocentes',
            'datos' => 'Activo',
            'tipo' => '0'
        ]);
        Configuracion::create([
            'nombre' => 'BloqueoCRN',
            'datos' => 'Activo',
            'tipo' => '1'
        ]);
        Configuracion::create([
            'nombre' => 'BloqueoPass',
            'datos' => 'Activo',
            'tipo' => '2'
        ]);
        Configuracion::create([
            'nombre' => 'Pass',
            'datos' => '12345',
            'tipo' => '3'
        ]);
        Configuracion::create([
            'nombre' => '201920',
            'datos' => '04/03/2019 | 31/03/2019',
            'tipo' => '4'
        ]);
        Configuracion::create([
            'nombre' => 'Benito',
            'datos' => '04/03/2019',
            'tipo' => '5'
        ]);
        Configuracion::create([
            'nombre' => 'NombreCamposTablaDocente',
            'datos' => 'ID,NOMBRE,APELLIDO PATERNO,APELLIDO MATERNO,ESTADO,FECHA REGISTRO,COMENTARIOS,No',
            'tipo' => '6'
        ]);
        Configuracion::create([
            'nombre' => 'CamposTablaDocente',
            'datos' => 'id_banner,nombre,apellido_paterno,apellido_materno,estatus,fecha_registro,comentario,id',
            'tipo' => '7'
        ]);
        Configuracion::create([
            'nombre' => 'SizeCamposTablaDocentes',
            'datos' => '60,100,130,130,80,130,200,10',
            'tipo' => '8'
        ]);
        Configuracion::create([
            'nombre' => 'NombreCamposFiltroDocentes',
            'datos' => 'ID BANNER,Nombre,Apellido Paterno,Apellido Materno,Estado,Comentario',
            'tipo' => '9'
        ]);
        Configuracion::create([
            'nombre' => 'CamposFiltroDocentes',
            'datos' => 'id_banner,nombre,apellido_paterno,apellido_materno,estatus,comentario',
            'tipo' => '10'
        ]);
        Configuracion::create([
            'nombre' => 'NombreCamposTablaMaterias',
            'datos' => 'CRN,DESCRIPCION,CALENDARIO,DIA,FECHA INICIO,FECHA FIN,HORA ENTRADA,HORA SALIDA,GRUPO,COMENTARIO,FECHA REGISTRO,No',
            'tipo' => '6'
        ]);
        Configuracion::create([
            'nombre' => 'CamposTablaMaterias',
            'datos' => 'crn,descripcion,calendario,dia,fecha_vig_ini,fecha_vig_fin,hora_ini,hora_fin,grupo,comentario,fecha_registro,id',
            'tipo' => '7'
        ]);
        Configuracion::create([
            'nombre' => 'SizeCamposTablaMaterias',
            'datos' => '70,120,90,60,80,80,70,70,50,100,100,10',
            'tipo' => '8'
        ]);
        Configuracion::create([
            'nombre' => '201940',
            'datos' => '13/05/2019 | 17/08/2019',
            'tipo' => '4'
        ]);
        Configuracion::create([
            'nombre' => '201960',
            'datos' => '09/09/2019 | 17/12/2019',
            'tipo' => '4'
        ]);
        Configuracion::create([
            'nombre' => 'NombreCamposTablaCrn',
            'datos' => 'CRN,NOMBRE,ESTADO,No',
            'tipo' => '6'
        ]);
        Configuracion::create([
            'nombre' => 'CamposTablaCrn',
            'datos' => 'crn,nombre,estado,id',
            'tipo' => '7'
        ]);
        Configuracion::create([
            'nombre' => 'SizeCamposTablaCrn',
            'datos' => '100,400,100,10',
            'tipo' => '8'
        ]);
        Configuracion::create([
            'nombre' => 'NombreCamposFiltroCrn',
            'datos' => 'CRN,NOMBRE',
            'tipo' => '9'
        ]);
        Configuracion::create([
            'nombre' => 'CamposFiltroCrn',
            'datos' => 'crn,nombre',
            'tipo' => '10'
        ]);
        Configuracion::create([
            'nombre' => 'NombreCamposTablaRegistroDocente',
            'datos' => 'D Docente,Materia,Registro,Fecha y hora',
            'tipo' => '6'
        ]);
        Configuracion::create([
            'nombre' => 'CamposTablaRegistroDocente',
            'datos' => 'docente_banner,crn_descripcion,tipo_registro,fecha_hora_reg',
            'tipo' => '7'
        ]);
        Configuracion::create([
            'nombre' => 'SizeCamposTablaRegistroDocente',
            'datos' => '100,300,100,150',
            'tipo' => '8'
        ]);
        Configuracion::create([
            'nombre' => 'LimitTablaRegistroDocente',
            'datos' => '20',
            'tipo' => '11'
        ]);

        factory(Configuracion::class,47)->create();
    }
}
