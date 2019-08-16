<?php

use Illuminate\Database\Seeder;
use App\Crn;

class CrnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Crn::class,47)->create();
    }
}
