<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(DocentesSeeder::class);
         $this->call(CrnSeeder::class);
         $this->call(ConfiguracionSeeder::class);
         $this->call(HorarioMateriaDocenteSeeder::class);
    }
}
