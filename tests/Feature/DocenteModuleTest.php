<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Docente;
use App\Configuracion;

class DocenteModuleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_loads_the_docente_list(){
        Configuracion::create([
            'nombre' => 'NombreCamposTablaDocente', 
            'datos' => 'ID,NOMBRE,APELLIDO PATERNO,APELLIDO MATERNO,ESTADO,FECHA REGISTRO,COMENTARIOS,No',
            'tipo' => 6,
        ]);
        Configuracion::create([
            'nombre' => 'CamposTablaDocente', 
            'datos' => 'id_banner,nombre,apellido_paterno,apellido_materno,estatus,fecha_registro,comentario,id',
            'tipo' => 7,
        ]);
        factory(Docente::class)->create([
            'nombre' => 'Joel',
        ]);
        factory(Docente::class)->create([
            'nombre' => 'Ellie',
        ]);

        $this->get(route('docente.index'))
            ->assertStatus(200)
            ->assertSee('Listado de docentes')
            ->assertSee('Joel')
            ->assertSee('Ellie');
    }
    /** @test */
    public function it_loads_the_docente_view_create(){
        $docente = factory(Docente::class)->create();

        $this->get(route('docente.create'))
            ->assertStatus(200)
            ->assertSee('Creación de registro');
    }
    /** @test */
    public function it_loads_the_docente_view_details(){
        $docente = factory(Docente::class)->create();

        $this->get(route('docente.show',$docente))
            ->assertStatus(200)
            ->assertSee('Vista detalle')
            ->assertSee($docente->apellido_paterno)
            ->assertSee($docente->nombre);
    }
    /** @test */
    public function it_loads_the_docente_view_edit(){
        $docente = factory(Docente::class)->create();

        $this->get(route('docente.edit',$docente))
            ->assertStatus(200)
            ->assertSee('Edición de registro')
            ->assertSee($docente->apellido_paterno)
            ->assertSee($docente->nombre);
    }
    /** @test */
    function it_create_a_new_docente(){
        $this->post(route('docente.store'),[
            'id_banner' => '00091819',
            'nombre' => 'Alfredo',
            'apellido_paterno' => 'Lomelí',
            'apellido_materno' => 'Ramírez',
            'estatus' => '1',
            'comentario' => 'Este es un comentario',
            ])->assertRedirect(route('docente.index'));
        $this->get(route('docente.index'))
            ->assertSee('Alfredo');

        $this->assertDatabaseHas('docentes',[
            'nombre' => 'Alfredo',
            'apellido_paterno' => 'Lomelí',
            'apellido_materno' => 'Ramírez',
        ]);
    }
    /** @test */
    function the_id_banner_is_required_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('id_banner');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function the_id_banner_must_be_between_8_and_10_caracters_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '0009',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('id_banner');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function the_id_banner_must_be_unique_to_create(){
        factory(Docente::class)->create([
            'id_banner' => '00091819',
        ]);
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('id_banner');
        $this->assertEquals(1,Docente::count());
    }
    /** @test */
    function the_nombre_is_required_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '00091819',
                'nombre' => '',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('nombre');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function the_nombre_must_be_between_0_and_100_caracters_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '00091819',
                'nombre' => '01234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('nombre');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function the_apellido_paterno_is_required_to_create_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => '',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('apellido_paterno');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function the_apellido_paterno_must_be_between_0_and_100_caracters_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => '01234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('apellido_paterno');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function the_apellido_materno_must_be_between_0_and_100_caracters_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => '01234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('apellido_materno');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function the_estatus_is_required_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('estatus');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function the_estatus_must_be_0_or_1_value_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '2',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('estatus');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function the_comentario_must_be_0_or_500_value_to_create(){
        $this->from(route('docente.create'))
            ->post(route('docente.store'), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'E012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            ])
            ->assertRedirect(route('docente.create'))
            ->assertSessionHasErrors('comentario');
        $this->assertEquals(0,Docente::count());
    }
    /** @test */
    function it_edit_a_docente(){
        // $this->withoutExceptionHandling();
        $docente = factory(Docente::class)->create([
            'id_banner' => '00091819',
        ]);
        $this->put(route('docente.update',$docente),[
            'id_banner' => '00091819',
            'nombre' => 'Alfredo',
            'apellido_paterno' => 'Lomelí',
            'apellido_materno' => 'Ramírez',
            'estatus' => '1',
            'comentario' => 'Este es un comentario',
            ])->assertRedirect(route('docente.show',$docente));
        $this->get(route('docente.index'))
            ->assertSee('Alfredo');

        $this->assertDatabaseHas('docentes',[
            'nombre' => 'Alfredo',
            'apellido_paterno' => 'Lomelí',
            'apellido_materno' => 'Ramírez',
        ]);
    }
    /** @test */
    function the_id_banner_is_required_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('id_banner');

        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_id_banner_must_be_between_8_and_10_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '0009',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('id_banner');

        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_id_banner_must_be_unique_to_edit(){
        factory(Docente::class)->create([
            'id_banner' => '00091820',
        ]);
        $docente = factory(Docente::class)->create([
            'id_banner' => '00091819',
        ]);
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '00091820',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('id_banner');
        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_nombre_is_required_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '00091819',
                'nombre' => '',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('nombre');
        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_nombre_must_be_between_0_and_100_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '00091819',
                'nombre' => '01234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('nombre');
        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_apellido_paterno_is_required_to_create_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => '',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('apellido_paterno');
        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_apellido_paterno_must_be_between_0_and_100_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => '01234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('apellido_paterno');
        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_apellido_materno_must_be_between_0_and_100_caracters_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => '01234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'estatus' => '1',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('apellido_materno');
        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_estatus_is_required_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('estatus');
        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_estatus_must_be_0_or_1_value_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '2',
                'comentario' => 'Este es un comentario',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('estatus');
        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function the_comentario_must_be_0_or_500_value_to_edit(){
        $docente = factory(Docente::class)->create();
        $this->from(route('docente.edit', $docente))
            ->put(route('docente.update', $docente), [
                'id_banner' => '00091819',
                'nombre' => 'Alfredo',
                'apellido_paterno' => 'Lomelí',
                'apellido_materno' => 'Ramírez',
                'estatus' => '1',
                'comentario' => 'E012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            ])
            ->assertRedirect(route('docente.edit', $docente))
            ->assertSessionHasErrors('comentario');
        $this->assertDatabaseHas('docentes',[
            'nombre' => $docente->nombre,
            'apellido_paterno' => $docente->apellido_paterno,
            'apellido_materno' => $docente->apellido_materno,
        ]);
    }
    /** @test */
    function it_deletes_a_docente(){
        $docente = factory(Docente::class)->create();

        $this->delete(route('docente.destroy', $docente))
            ->assertRedirect(route('docente.index'));

        $this->assertDatabaseMissing('docentes',[
            'id' => $docente->id,
        ]);
    }
}
