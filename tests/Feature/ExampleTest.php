<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /** @test */
    public function it_show_the_welcome_page()
    {
        $this->get(route('inicio'))
            ->assertStatus(200)
            ->assertSee('Sistema para el control de asistencia')
            ->assertSee('Docentes')
            ->assertSee('MATERIAS')
            ->assertSee('Horarios')
            ->assertSee('Reportes')
            ->assertSee('Administrativos');
    }
}
