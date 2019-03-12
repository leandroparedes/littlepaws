<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre' => 'Categoria 1'
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Categoria 2'
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Categoria 3'
        ]);
    }
}
