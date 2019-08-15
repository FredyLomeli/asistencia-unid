<?php

use Illuminate\Database\Seeder;
use App\Docente;

class DocentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Docente::class,47)->create();
    }
}
