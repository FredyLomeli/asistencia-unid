<?php

use App\HorarioMateriaDocente;
use Illuminate\Database\Seeder;

class HorarioMateriaDocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(HorarioMateriaDocente::class,47)->create();
    }
}
