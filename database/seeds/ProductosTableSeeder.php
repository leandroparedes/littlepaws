<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 6; $i++) {
            DB::table('productos')->insert([
                'nombre' => 'Producto test ' . $i,
                'precio' => rand(10000, 30000),
                'stock' => rand(0, 15),
                'descuento' => rand(15, 40),
                'image_url' => 'https://via.placeholder.com/' . rand(150, 200),
                'id_categoria' => rand(1, 3)
            ]);
        }

        for($i = 6; $i < 10; $i++) {
            DB::table('productos')->insert([
                'nombre' => 'Producto test ' . $i,
                'precio' => rand(5000, 30000),
                'stock' => rand(0, 5),
                'descuento' => 0,
                'image_url' => 'https://via.placeholder.com/' . rand(150, 200),
                'id_categoria' => rand(1, 3)
            ]);
        }
    }
}
