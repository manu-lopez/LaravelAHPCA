<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('datos')->insert([
            'nombre' => str_random(10),
            'apellidos' => str_random(6).' '.str_random(6),
            'titulo' => str_random(15),
        ]);
    }
}
