<?php

namespace Tests\Feature;

use App\Docente;
use App\Crn;
use App\Configuracion;
use App\HorarioMateriaDocente;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HorarioMateriaDocenteModuleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_loads_the_horario_list(){
        Configuracion::create([
            'nombre' => 'NombreCamposTablaMaterias',
            'datos' => 'CRN,DESCRIPCION,CALENDARIO,DIA,FECHA INICIO,FECHA FIN,HORA ENTRADA,HORA SALIDA,GRUPO,COMENTARIO,FECHA REGISTRO,No',
            'tipo' => 6,
        ]);
        Configuracion::create([
            'nombre' => 'CamposTablaMaterias',
            'datos' => 'crn,descripcion,calendario,dia,fecha_vig_ini,fecha_vig_fin,hora_ini,hora_fin,grupo,comentario,fecha_registro,id',
            'tipo' => 7,
        ]);
        factory(HorarioMateriaDocente::class)->create([
            'descripcion' => 'Tecnologia Educativa',
        ]);
        factory(HorarioMateriaDocente::class)->create([
            'descripcion' => 'Herramientas Tecnologicas',
        ]);

        $this->get(route('horarioDocente.index'))
            ->assertStatus(200)
            ->assertSee('Listado de horarios')
            ->assertSee('Tecnologia Educativa')
            ->assertSee('Herramientas Tecnologicas');
    }
    /** @test */
    public function it_loads_the_horario_view_create(){
        $horario = factory(HorarioMateriaDocente::class)->create();

        $this->get(route('horarioDocente.create'))
            ->assertStatus(200)
            ->assertSee('Creación de registro');
    }
    /** @test */
    public function it_loads_the_horario_view_details(){
        $horario = factory(HorarioMateriaDocente::class)->create();

        $this->get(route('horarioDocente.show',$horario))
            ->assertStatus(200)
            ->assertSee('Vista detalle')
            ->assertSee($horario->descripcion)
            ->assertSee($horario->id_docente);
    }
    /** @test */
    public function it_loads_the_horario_view_edit(){
        $horario = factory(HorarioMateriaDocente::class)->create();

        $this->get(route('horarioDocente.edit',$horario))
            ->assertStatus(200)
            ->assertSee('Edición de registro')
            ->assertSee($horario->descripcion)
            ->assertSee($horario->id_docente);
    }
    /** @test */
    function it_create_a_new_horario(){
        Configuracion::create([
            'nombre' => 'NombreCamposTablaMaterias',
            'datos' => 'CRN,DESCRIPCION,CALENDARIO,DIA,FECHA INICIO,FECHA FIN,HORA ENTRADA,HORA SALIDA,GRUPO,COMENTARIO,FECHA REGISTRO,No',
            'tipo' => 6,
        ]);
        Configuracion::create([
            'nombre' => 'CamposTablaMaterias',
            'datos' => 'crn,descripcion,calendario,dia,fecha_vig_ini,fecha_vig_fin,hora_ini,hora_fin,grupo,comentario,fecha_registro,id',
            'tipo' => 7,
        ]);

        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->post(route('horarioDocente.store'),[
            'crn' => $crn->crn,
            'descripcion' => $crn->nombre,
            'id_docente' => $docente->id_banner,
            'dia' => 5,
            'fecha_vig_ini' => '1972-05-18',
            'fecha_vig_fin' => '1973-05-18',
            'hora_ini' => '08:08:35',
            'hora_fin' => '10:04:25',
            'grupo' => 'grupo1',
            'calendario' => '201940',
            'comentario' => 'Comentario 1',
            ])->assertRedirect(route('horarioDocente.index'));
        $this->get(route('horarioDocente.index'))
            ->assertSee($crn->nombre);

        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $crn->crn,
            'descripcion' => $crn->nombre,
            'id_docente' => $docente->id_banner,
            'dia' => 5,
            'fecha_vig_ini' => '1972-05-18',
            'fecha_vig_fin' => '1973-05-18',
            'hora_ini' => '08:08:35',
            'hora_fin' => '10:04:25',
            'grupo' => 'grupo1',
            'calendario' => '201940',
            'comentario' => 'Comentario 1',
        ]);
    }
    /** @test */
    function the_crn_is_required_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create([
            'crn' => '63454'
        ]);
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => '',
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('crn');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_crn_must_be_between_5_and_8_caracters_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create([
            'crn' => '63454'
        ]);
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => '6345',
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('crn');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_crn_must_be_exist_in_crn_table_to_create(){
        $docente = factory(Docente::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => '63454',
                'descripcion' => 'Tecnologia Educativa',
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('crn');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_descripcion_is_required_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => '',
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('descripcion');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_descripcion_must_be_between_1_and_250_caracters_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('descripcion');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_id_docente_is_required_to_create_to_create(){
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => '',
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('id_docente');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_id_docente_must_be_exist_in_docente_table_to_create(){
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => '00091819',
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('id_docente');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_id_docente_must_be_between_8_and_10_caracters_to_create(){
        $docente = factory(Docente::class)->create([
            'id_banner' => '00091819'
        ]);
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => '0091819',
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('id_docente');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_dia_is_required_to_create_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => '',
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('dia');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_dia_is_must_be_between_1_and_7_caracters_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 7,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('dia');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_fecha_vig_ini_is_required_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('fecha_vig_ini');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_fecha_vig_ini_must_have_format_Y_m_d_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '197-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('fecha_vig_ini');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_fecha_vig_ini_must_before_fecha_vig_fin_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1974-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('fecha_vig_ini');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_fecha_vig_fin_is_required_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1973-05-18',
                'fecha_vig_fin' => '',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('fecha_vig_fin');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_fecha_vig_fin_must_have_format_Y_m_d_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '197-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('fecha_vig_fin');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_hora_ini_is_required_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('hora_ini');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_hora_ini_must_have_format_H_i_s_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '30:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('hora_ini');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_hora_ini_must_before_hora_fin_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '12:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('hora_ini');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_hora_fin_is_required_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('hora_fin');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_hora_fin_must_have_format_H_i_s_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '30:08:35',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('hora_fin');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_grupo_must_be_between_0_and_250_caracters_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '12:08:35',
                'grupo' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('grupo');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_calendario_must_be_between_0_and_200_caracters_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '12:08:35',
                'grupo' => 'grupo 1',
                'calendario' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('calendario');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function the_comentario_must_be_between_0_and_500_caracters_to_create(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $this->from(route('horarioDocente.create'))
            ->post(route('horarioDocente.store'), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '12:08:35',
                'grupo' => 'grupo 1',
                'calendario' => '201920',
                'comentario' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            ])
            ->assertRedirect(route('horarioDocente.create'))
            ->assertSessionHasErrors('comentario');
        $this->assertEquals(0,HorarioMateriaDocente::count());
    }
    /** @test */
    function it_edit_a_horario(){
        Configuracion::create([
            'nombre' => 'NombreCamposTablaMaterias',
            'datos' => 'CRN,DESCRIPCION,CALENDARIO,DIA,FECHA INICIO,FECHA FIN,HORA ENTRADA,HORA SALIDA,GRUPO,COMENTARIO,FECHA REGISTRO,No',
            'tipo' => 6,
        ]);
        Configuracion::create([
            'nombre' => 'CamposTablaMaterias',
            'datos' => 'crn,descripcion,calendario,dia,fecha_vig_ini,fecha_vig_fin,hora_ini,hora_fin,grupo,comentario,fecha_registro,id',
            'tipo' => 7,
        ]);

        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->put(route('horarioDocente.update', $horario),[
            'crn' => $crn->crn,
            'descripcion' => $crn->nombre,
            'id_docente' => $docente->id_banner,
            'dia' => 5,
            'fecha_vig_ini' => '1972-05-18',
            'fecha_vig_fin' => '1973-05-18',
            'hora_ini' => '08:08:35',
            'hora_fin' => '10:04:25',
            'grupo' => 'grupo1',
            'calendario' => '201940',
            'comentario' => 'Comentario 1',
            ])->assertRedirect(route('horarioDocente.show',$horario));
        $this->get(route('horarioDocente.index'))
            ->assertSee($crn->nombre);
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $crn->crn,
            'descripcion' => $crn->nombre,
            'id_docente' => $docente->id_banner,
            'dia' => 5,
            'fecha_vig_ini' => '1972-05-18',
            'fecha_vig_fin' => '1973-05-18',
            'hora_ini' => '08:08:35',
            'hora_fin' => '10:04:25',
            'grupo' => 'grupo1',
            'calendario' => '201940',
            'comentario' => 'Comentario 1',
        ]);
    }
    /** @test */
    function the_crn_is_required_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => '',
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('crn');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_crn_must_be_between_5_and_8_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create([
            'crn' => '63454'
        ]);
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => '6345',
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('crn');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_crn_must_be_exist_in_crn_table_to_edit(){
        $docente = factory(Docente::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => '63454',
                'descripcion' => 'Tecnologia Educativa',
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('crn');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_descripcion_is_required_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => '',
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('descripcion');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_descripcion_must_be_between_1_and_250_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('descripcion');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_id_docente_is_required_to_create_to_edit(){
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => '',
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('id_docente');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_id_docente_must_be_exist_in_docente_table_to_edit(){
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => '00091819',
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('id_docente');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_id_docente_must_be_between_8_and_10_caracters_to_edit(){
        $docente = factory(Docente::class)->create([
            'id_banner' => '00091819'
        ]);
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => '0091819',
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('id_docente');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_dia_is_required_to_create_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => '',
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('dia');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_dia_is_must_be_between_1_and_7_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 7,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('dia');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_fecha_vig_ini_is_required_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('fecha_vig_ini');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_fecha_vig_ini_must_have_format_Y_m_d_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '197-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('fecha_vig_ini');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_fecha_vig_ini_must_before_fecha_vig_fin_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1974-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('fecha_vig_ini');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_fecha_vig_fin_is_required_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1973-05-18',
                'fecha_vig_fin' => '',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('fecha_vig_fin');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_fecha_vig_fin_must_have_format_Y_m_d_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '197-05-18',
                'hora_ini' => '08:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('fecha_vig_fin');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_hora_ini_is_required_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('hora_ini');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_hora_ini_must_have_format_H_i_s_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '30:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('hora_ini');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_hora_ini_must_before_hora_fin_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '12:08:35',
                'hora_fin' => '10:04:25',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('hora_ini');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_hora_fin_is_required_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('hora_fin');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_hora_fin_must_have_format_H_i_s_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '30:08:35',
                'grupo' => 'grupo1',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('hora_fin');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_grupo_must_be_between_0_and_250_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '12:08:35',
                'grupo' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'calendario' => '201940',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('grupo');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_calendario_must_be_between_0_and_200_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '12:08:35',
                'grupo' => 'grupo 1',
                'calendario' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'comentario' => 'Comentario 1',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('calendario');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function the_comentario_must_be_between_0_and_500_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $crn = factory(Crn::class)->create();
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->from(route('horarioDocente.edit', $horario))
            ->put(route('horarioDocente.update', $horario), [
                'crn' => $crn->crn,
                'descripcion' => $crn->nombre,
                'id_docente' => $docente->id_banner,
                'dia' => 5,
                'fecha_vig_ini' => '1972-05-18',
                'fecha_vig_fin' => '1973-05-18',
                'hora_ini' => '10:04:25',
                'hora_fin' => '12:08:35',
                'grupo' => 'grupo 1',
                'calendario' => '201920',
                'comentario' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            ])
            ->assertRedirect(route('horarioDocente.edit', $horario))
            ->assertSessionHasErrors('comentario');
        $this->assertDatabaseHas('horario_materia_docente',[
            'crn' => $horario->crn,
            'descripcion' => $horario->descripcion,
            'id_docente' => $horario->id_docente,
        ]);
    }
    /** @test */
    function it_deletes_a_horario(){
        $horario = factory(HorarioMateriaDocente::class)->create();
        $this->delete(route('horarioDocente.destroy', $horario))
            ->assertRedirect(route('horarioDocente.index'));
        $this->assertDatabaseMissing('horario_materia_docente',[
            'id' => $horario->id,
        ]);
    }
}
