<?php

namespace Tests\Feature;

use App\Configuracion;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfiguracionModuleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_loads_the_configuracion_list(){
        factory(Configuracion::class)->create([
            'nombre' => 'NombreCamposTablaDocente',
        ]);
        factory(Configuracion::class)->create([
            'nombre' => 'CamposTablaDocente',
        ]);

        $this->get(route('config.index'))
            ->assertStatus(200)
            ->assertSee('Listado de Configuraciones')
            ->assertSee('NombreCamposTablaDocente')
            ->assertSee('CamposTablaDocente');
    }
    /** @test */
    public function it_loads_the_configuracion_view_create(){
        $this->get(route('config.create'))
            ->assertStatus(200)
            ->assertSee('Creación de registro');
    }
    /** @test */
    public function it_loads_the_configuracion_view_details(){
        $config = factory(Configuracion::class)->create();

        $this->get(route('config.show',$config))
            ->assertStatus(200)
            ->assertSee('Ver detalle')
            ->assertSee($config->nombre)
            ->assertSee($config->datos);
    }
    /** @test */
    public function it_loads_the_configuracion_tipo_asueto_view_details(){
        $config = factory(Configuracion::class)->create([
            'datos' => '30/01/2019',
            'tipo' => '5',
        ]);

        $this->get(route('config.show',$config))
            ->assertStatus(200)
            ->assertSee('Ver detalle')
            ->assertSee($config->nombre)
            ->assertSee('30/01/2019');
    }
    /** @test */
    public function it_loads_the_configuracion_tipo_calendario_view_details(){
        $config = factory(Configuracion::class)->create([
            'datos' => '30/01/2019 | 24/04/2019',
            'tipo' => '5',
        ]);

        $this->get(route('config.show',$config))
            ->assertStatus(200)
            ->assertSee('Ver detalle')
            ->assertSee($config->nombre)
            ->assertSee('30/01/2019')
            ->assertSee('24/04/2019');
    }
    /** @test */
    public function it_loads_the_configuracion_view_edit(){
        $config = factory(Configuracion::class)->create();

        $this->get(route('config.edit',$config))
            ->assertStatus(200)
            ->assertSee('Edición de registro')
            ->assertSee($config->nombre)
            ->assertSee($config->datos);
    }
    /** @test */
    public function it_loads_the_configuracion_tipo_asueto_view_edit(){
        $config = factory(Configuracion::class)->create([
            'datos' => '30/01/2019',
            'tipo' => '5',
        ]);

        $this->get(route('config.edit',$config))
            ->assertStatus(200)
            ->assertSee('Edición de registro')
            ->assertSee($config->nombre)
            ->assertSee('30/01/2019');
    }
    /** @test */
    public function it_loads_the_configuracion_tipo_calendario_view_edit(){
        $config = factory(Configuracion::class)->create([
            'datos' => '30/01/2019 | 24/04/2019',
            'tipo' => '4',
        ]);

        $this->get(route('config.edit',$config))
            ->assertStatus(200)
            ->assertSee('Edición de registro')
            ->assertSee($config->nombre)
            ->assertSee('30/01/2019')
            ->assertSee('24/04/2019');
    }
    /** @test */
    function it_create_a_new_configuracion(){
        $this->post(route('config.store'),[
            'nombre' => 'NombreDeLaConfiguracion',
            'datos' => 'Datos,De,La,Configuracion',
            'tipo' => '6',
            ])->assertRedirect(route('config.index'));
        $this->get(route('config.index'))
            ->assertSee('NombreDeLaConfiguracion');

        $this->assertDatabaseHas('configuracion',[
            'nombre' => 'NombreDeLaConfiguracion',
            'datos' => 'Datos,De,La,Configuracion',
            'tipo' => '6',
        ]);
    }
    /** @test */
    function it_create_a_new_configuracion_tipo_auseto(){
        $this->post(route('config.store'),[
            'nombre' => 'NombreDeLaConfiguracion',
            'fecha' => '10/10/2019',
            'tipo' => '5',
            ])->assertRedirect(route('config.index'));
        $this->get(route('config.index'))
            ->assertSee('NombreDeLaConfiguracion');

        $this->assertDatabaseHas('configuracion',[
            'nombre' => 'NombreDeLaConfiguracion',
            'datos' => '10/10/2019',
            'tipo' => '5',
        ]);
    }
    /** @test */
    function it_create_a_new_configuracion_tipo_calendario(){
        $this->post(route('config.store'),[
            'nombre' => 'NombreDeLaConfiguracion',
            'fec_ini' => '01/01/2019',
            'fec_fin' => '30/04/2019',
            'tipo' => '4',
            ])->assertRedirect(route('config.index'));
        $this->get(route('config.index'))
            ->assertSee('NombreDeLaConfiguracion');

        $this->assertDatabaseHas('configuracion',[
            'nombre' => 'NombreDeLaConfiguracion',
            'datos' => '01/01/2019 | 30/04/2019',
            'tipo' => '4',
        ]);
    }
    /** @test */
    function the_nombre_is_required_to_create(){
        $this->from(route('config.create'))
            ->post(route('config.store'), [
                'nombre' => '',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('nombre');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_nombre_must_be_between_1_and_250_caracters_to_create(){
        $this->from(route('config.create'))
            ->post(route('config.store'), [
                'nombre' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('nombre');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_nombre_must_be_unique_to_create(){
        factory(Configuracion::class)->create([
            'nombre' => 'NombreDeLaConfiguracion',
        ]);
        $this->from(route('config.create'))
            ->post(route('config.store'), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('nombre');
        $this->assertEquals(1,Configuracion::count());
    }
    /** @test */
    function the_datos_is_required_to_create(){
        $this->from(route('config.create'))
            ->post(route('config.store'), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => '',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('datos');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_datos_must_be_between_1_and_255_caracters_to_create(){
        $this->from(route('config.create'))
            ->post(route('config.store'), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('datos');
        $this->assertEquals(0,Configuracion::count());
    }

    /** @test */
    function the_tipo_is_required_to_create(){
        $this->from(route('config.create'))
            ->post(route('config.store'), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '',
            ])
            ->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('tipo');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_tipo_must_be_0_and_11_value_to_create(){
        $this->from(route('config.create'))
            ->post(route('config.store'), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '12',
            ])
            ->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('tipo');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_fecha_is_required_to_create_a_new_configuracion_tipo_auseto(){
        $this->from(route('config.create'))
            ->post(route('config.store'),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fecha' => '',
                'tipo' => '5',
            ])->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('fecha');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_fecha_need_format_d_m_Y_to_create_a_new_configuracion_tipo_auseto(){
        $this->from(route('config.create'))
            ->post(route('config.store'),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fecha' => '10/10/201',
                'tipo' => '5',
            ])->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('fecha');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_fec_ini_is_required_to_create_a_new_configuracion_tipo_calendario(){
        $this->from(route('config.create'))
            ->post(route('config.store'),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '',
                'fec_fin' => '30/04/2019',
                'tipo' => '4',
            ])->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('fec_ini');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_fec_ini_need_format_d_m_Y_to_create_a_new_configuracion_tipo_calendario(){
        $this->from(route('config.create'))
            ->post(route('config.store'),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '10/10/201',
                'fec_fin' => '30/04/2019',
                'tipo' => '4',
            ])->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('fec_ini');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_fec_ini_before_than_fec_fin_to_create_a_new_configuracion_tipo_calendario(){
        $this->from(route('config.create'))
            ->post(route('config.store'),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '10/10/2020',
                'fec_fin' => '30/04/2019',
                'tipo' => '4',
            ])->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('fec_ini');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_fec_fin_is_required_to_create_a_new_configuracion_tipo_calendario(){
        $this->from(route('config.create'))
            ->post(route('config.store'),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '30/04/2019',
                'fec_fin' => '',
                'tipo' => '4',
            ])->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('fec_fin');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function the_fec_fin_need_format_d_m_Y_to_create_a_new_configuracion_tipo_calendario(){
        $this->from(route('config.create'))
            ->post(route('config.store'),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '10/10/2019',
                'fec_fin' => '30/04/201',
                'tipo' => '4',
            ])->assertRedirect(route('config.create'))
            ->assertSessionHasErrors('fec_fin');
        $this->assertEquals(0,Configuracion::count());
    }
    /** @test */
    function it_edit_a_configuracion(){
        // $this->withoutExceptionHandling();
        $config = factory(Configuracion::class)->create();
        $this->put(route('config.update',$config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '6',
            ])->assertRedirect(route('config.show',$config));
        $this->get(route('config.index'))
            ->assertSee('NombreDeLaConfiguracion');

        $this->assertDatabaseHas('configuracion',[
            'nombre' => 'NombreDeLaConfiguracion',
            'datos' => 'Datos,De,La,Configuracion',
            'tipo' => '6',
        ]);
    }
    /** @test */
    function it_edit_a_configuracion_tipo_auseto(){
        $config = factory(Configuracion::class)->create();
        $this->put(route('config.update', $config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fecha' => '30/04/2019',
                'tipo' => '5',
            ])->assertRedirect(route('config.show', $config));
        $this->get(route('config.index'))
            ->assertSee('NombreDeLaConfiguracion');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => 'NombreDeLaConfiguracion',
            'datos' => '30/04/2019',
            'tipo' => '5',
        ]);
    }
    /** @test */
    function it_edit_a_configuracion_tipo_calendario(){
        $config = factory(Configuracion::class)->create();
        $this->put(route('config.update', $config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '01/01/2019',
                'fec_fin' => '30/04/2019',
                'tipo' => '4',
            ])->assertRedirect(route('config.show', $config));
        $this->assertDatabaseHas('configuracion',[
            'nombre' => 'NombreDeLaConfiguracion',
            'datos' => '01/01/2019 | 30/04/2019',
            'tipo' => '4',
        ]);
    }
    /** @test */
    function the_nombre_is_required_to_edit(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config), [
                'nombre' => '',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('nombre');

        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_nombre_must_be_between_1_and_250_caracters_to_edit(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config), [
                'nombre' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('nombre');

        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_nombre_must_be_unique_to_edit(){
        factory(Configuracion::class)->create([
            'nombre' => 'NombreDeLaConfiguracion',
        ]);
        $config = factory(Configuracion::class)->create([
            'nombre' => 'NombreDeLaConfiguracio',
        ]);
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('nombre');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_datos_is_required_to_edit(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => '',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('datos');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_datos_must_be_between_0_and_255_caracters_to_edit(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
                'tipo' => '6',
            ])
            ->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('datos');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_tipo_is_required_to_edit(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '',
            ])
            ->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('tipo');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_tipo_must_be_0_or_11_value_to_edit(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config), [
                'nombre' => 'NombreDeLaConfiguracion',
                'datos' => 'Datos,De,La,Configuracion',
                'tipo' => '12',
            ])
            ->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('tipo');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_fecha_is_required_to_edit_a_configuracion_tipo_auseto(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fecha' => '',
                'tipo' => '5',
            ])->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('fecha');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_fecha_need_format_d_m_Y_to_edit_a_configuracion_tipo_auseto(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fecha' => '10/10/201',
                'tipo' => '5',
            ])->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('fecha');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_fec_ini_is_required_to_edit_a_configuracion_tipo_calendario(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '',
                'fec_fin' => '30/04/2019',
                'tipo' => '4',
            ])->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('fec_ini');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_fec_ini_need_format_d_m_Y_to_edit_a_configuracion_tipo_calendario(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '10/10/201',
                'fec_fin' => '30/04/2019',
                'tipo' => '4',
            ])->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('fec_ini');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_fec_ini_before_than_fec_fin_to_edit_a_configuracion_tipo_calendario(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '10/10/2020',
                'fec_fin' => '30/04/2019',
                'tipo' => '4',
            ])->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('fec_ini');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_fec_fin_is_required_to_edit_a_configuracion_tipo_calendario(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '30/04/2019',
                'fec_fin' => '',
                'tipo' => '4',
            ])->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('fec_fin');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function the_fec_fin_need_format_d_m_Y_to_edit_a_configuracion_tipo_calendario(){
        $config = factory(Configuracion::class)->create();
        $this->from(route('config.edit', $config))
            ->put(route('config.update', $config),[
                'nombre' => 'NombreDeLaConfiguracion',
                'fec_ini' => '10/10/2019',
                'fec_fin' => '30/04/201',
                'tipo' => '4',
            ])->assertRedirect(route('config.edit', $config))
            ->assertSessionHasErrors('fec_fin');
        $this->assertDatabaseHas('configuracion',[
            'nombre' => $config->nombre,
            'datos' => $config->datos,
            'tipo' => $config->tipo,
        ]);
    }
    /** @test */
    function it_deletes_a_configuracion(){
        $config = factory(Configuracion::class)->create();
        $this->delete(route('config.destroy', $config))
            ->assertRedirect(route('config.index'));
        $this->assertDatabaseMissing('configuracion',[
            'id' => $config->id,
        ]);
    }
}
