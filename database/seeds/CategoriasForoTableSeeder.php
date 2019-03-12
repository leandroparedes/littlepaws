<?php

use Illuminate\Database\Seeder;

class CategoriasForoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_foros')->insert([
            'categoria' => 'Perros'
        ]);

        DB::table('categoria_foros')->insert([
            'categoria' => 'Gatos'
        ]);

        DB::table('categoria_foros')->insert([
            'categoria' => 'Mascotas exóticas'
        ]);

        DB::table('categoria_foros')->insert([
            'categoria' => 'Salud'
        ]);

        DB::table('categoria_foros')->insert([
            'categoria' => 'Higiene'
        ]);

        DB::table('categoria_foros')->insert([
            'categoria' => 'Estética'
        ]);
    }
}
