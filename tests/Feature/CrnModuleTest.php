<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Crn;
use App\Configuracion;

class CrnModuleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_loads_the_materias_list(){
        Configuracion::create([
            'nombre' => 'NombreCamposTablaCrn', 
            'datos' => 'CRN,NOMBRE,ESTADO,ID',
            'tipo' => 6,
        ]);
        Configuracion::create([
            'nombre' => 'CamposTablaCrn', 
            'datos' => 'crn,nombre,estado,id',
            'tipo' => 7,
        ]);
        factory(Crn::class)->create([
            'nombre' => 'Tecnologia Educativa',
        ]);
        factory(Crn::class)->create([
            'nombre' => 'Herrramientas digitales',
        ]);

        $this->get(route('crn.index'))
            ->assertStatus(200)
            ->assertSee('Listado de Materias')
            ->assertSee('Tecnologia Educativa')
            ->assertSee('Herrramientas digitales');
    }
    /** @test */
    public function it_loads_the_materias_view_create(){
        $crn = factory(Crn::class)->create();

        $this->get(route('crn.create'))
            ->assertStatus(200)
            ->assertSee('Creación de registro');
    }
    /** @test */
    public function it_loads_the_materias_view_details(){
        $crn = factory(Crn::class)->create();

        $this->get(route('crn.show',$crn))
            ->assertStatus(200)
            ->assertSee('Vista detalle')
            ->assertSee($crn->crn)
            ->assertSee($crn->nombre);
    }
    /** @test */
    public function it_loads_the_materias_view_edit(){
        $crn = factory(Crn::class)->create();

        $this->get(route('crn.edit',$crn))
            ->assertStatus(200)
            ->assertSee('Edición de registro')
            ->assertSee($crn->crn)
            ->assertSee($crn->nombre);
    }
    /** @test */
    function it_create_a_new_materias(){
        $this->post(route('crn.store'),[
            'crn' => '63454',
            'nombre' => 'Tecnologia Educativa',
            'estado' => '1',
            ])->assertRedirect(route('crn.index'));
        $this->get(route('crn.index'))
            ->assertSee('Tecnologia Educativa');

        $this->assertDatabaseHas('crn',[
            'crn' => '63454',
            'nombre' => 'Tecnologia Educativa',
            'estado' => '1',
        ]);
    }
    /** @test */
    function the_crn_is_required_to_create(){
        $this->from(route('crn.create'))
            ->post(route('crn.store'), [
                'crn' => '',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.create'))
            ->assertSessionHasErrors('crn');
        $this->assertEquals(0,Crn::count());
    }
    /** @test */
    function the_crn_must_be_between_5_and_8_caracters_to_create(){
        $this->from(route('crn.create'))
            ->post(route('crn.store'), [
                'crn' => '6345',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.create'))
            ->assertSessionHasErrors('crn');
        $this->assertEquals(0,Crn::count());
    }
    /** @test */
    function the_crn_must_be_unique_to_create(){
        factory(Crn::class)->create([
            'crn' => '63454',
        ]);
        $this->from(route('crn.create'))
            ->post(route('crn.store'), [
                'crn' => '63454',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.create'))
            ->assertSessionHasErrors('crn');
        $this->assertEquals(1,Crn::count());
    }
    /** @test */
    function the_nombre_is_required_to_create(){
        $this->from(route('crn.create'))
            ->post(route('crn.store'), [
                'crn' => '63454',
                'nombre' => '',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.create'))
            ->assertSessionHasErrors('nombre');
        $this->assertEquals(0,Crn::count());
    }
    /** @test */
    function the_nombre_must_be_between_0_and_255_caracters_to_create(){
        $this->from(route('crn.create'))
            ->post(route('crn.store'), [
                'crn' => '63454',
                'nombre' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.create'))
            ->assertSessionHasErrors('nombre');
        $this->assertEquals(0,Crn::count());
    }
   
    /** @test */
    function the_estado_is_required_to_create(){
        $this->from(route('crn.create'))
            ->post(route('crn.store'), [
                'crn' => '63454',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '',
            ])
            ->assertRedirect(route('crn.create'))
            ->assertSessionHasErrors('estado');
        $this->assertEquals(0,Crn::count());
    }
    /** @test */
    function the_estado_must_be_0_or_1_value_to_create(){
        $this->from(route('crn.create'))
            ->post(route('crn.store'), [
                'crn' => '63454',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '2',
            ])
            ->assertRedirect(route('crn.create'))
            ->assertSessionHasErrors('estado');
        $this->assertEquals(0,Crn::count());
    }
    function it_edit_a_materia(){
        // $this->withoutExceptionHandling();
        $crn = factory(Crn::class)->create();
        $this->put(route('crn.update',$crn),[
                'crn' => '63454',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '1',
            ])->assertRedirect(route('crn.show',$crn));
        $this->get(route('crn.index'))
            ->assertSee('Tecnologia Educativa');

        $this->assertDatabaseHas('crn',[
            'crn' => '63454',
            'nombre' => 'Tecnologia Educativa',
            'estado' => '1',
        ]);
    }
    /** @test */
    function the_crn_is_required_to_edit(){
        $crn = factory(Crn::class)->create();
        $this->from(route('crn.edit', $crn))
            ->put(route('crn.update', $crn), [
                'crn' => '',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.edit', $crn))
            ->assertSessionHasErrors('crn');

        $this->assertDatabaseHas('crn',[
            'crn' => $crn->crn,
            'nombre' => $crn->nombre,
            'estado' => $crn->estado,
        ]);
    }
    /** @test */
    function the_crn_must_be_between_5_and_8_caracters_to_edit(){
        $crn = factory(Crn::class)->create();
        $this->from(route('crn.edit', $crn))
            ->put(route('crn.update', $crn), [
                'crn' => '6345',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.edit', $crn))
            ->assertSessionHasErrors('crn');

        $this->assertDatabaseHas('crn',[
            'crn' => $crn->crn,
            'nombre' => $crn->nombre,
            'estado' => $crn->estado,
        ]);
    }
    /** @test */
    function the_crn_must_be_unique_to_edit(){
        factory(Crn::class)->create([
            'crn' => '63454',
        ]);
        $crn = factory(Crn::class)->create([
            'crn' => '63455',
        ]);
        $this->from(route('crn.edit', $crn))
            ->put(route('crn.update', $crn), [
                'crn' => '63454',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.edit', $crn))
            ->assertSessionHasErrors('crn');
        $this->assertDatabaseHas('crn',[
            'crn' => $crn->crn,
            'nombre' => $crn->nombre,
            'estado' => $crn->estado,
        ]);
    }
    /** @test */
    function the_nombre_is_required_to_edit(){
        $crn = factory(Crn::class)->create();
        $this->from(route('crn.edit', $crn))
            ->put(route('crn.update', $crn), [
                'crn' => '63454',
                'nombre' => '',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.edit', $crn))
            ->assertSessionHasErrors('nombre');
        $this->assertDatabaseHas('crn',[
            'crn' => $crn->crn,
            'nombre' => $crn->nombre,
            'estado' => $crn->estado,
        ]);
    }
    /** @test */
    function the_nombre_must_be_between_0_and_255_caracters_to_edit(){
        $crn = factory(Crn::class)->create();
        $this->from(route('crn.edit', $crn))
            ->put(route('crn.update', $crn), [
                'crn' => '63454',
                'nombre' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'estado' => '1',
            ])
            ->assertRedirect(route('crn.edit', $crn))
            ->assertSessionHasErrors('nombre');
        $this->assertDatabaseHas('crn',[
            'crn' => $crn->crn,
            'nombre' => $crn->nombre,
            'estado' => $crn->estado,
        ]);
    }
    /** @test */
    function the_estado_is_required_to_edit(){
        $crn = factory(Crn::class)->create();
        $this->from(route('crn.edit', $crn))
            ->put(route('crn.update', $crn), [
                'crn' => '63454',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '',
            ])
            ->assertRedirect(route('crn.edit', $crn))
            ->assertSessionHasErrors('estado');
        $this->assertDatabaseHas('crn',[
            'crn' => $crn->crn,
            'nombre' => $crn->nombre,
            'estado' => $crn->estado,
        ]);
    }
    /** @test */
    function the_estado_must_be_0_or_1_value_to_edit(){
        $crn = factory(Crn::class)->create();
        $this->from(route('crn.edit', $crn))
            ->put(route('crn.update', $crn), [
                'crn' => '63454',
                'nombre' => 'Tecnologia Educativa',
                'estado' => '2',
            ])
            ->assertRedirect(route('crn.edit', $crn))
            ->assertSessionHasErrors('estado');
        $this->assertDatabaseHas('crn',[
            'crn' => $crn->crn,
            'nombre' => $crn->nombre,
            'estado' => $crn->estado,
        ]);
    }
    /** @test */
    function it_deletes_a_materia(){
        $crn = factory(Crn::class)->create();
        $this->delete(route('crn.destroy', $crn))
            ->assertRedirect(route('crn.index'));
        $this->assertDatabaseMissing('crn',[
            'id' => $crn->id,
        ]);
    }
}
