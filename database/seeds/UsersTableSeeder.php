<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => 'Juanito',
            'apellido' => 'Perez',
            'email' => 'juanito@gmail.com',
            'password' => bcrypt('juanito')
        ]);

        DB::table('users')->insert([
            'nombre' => 'Esteban',
            'apellido' => 'Venegas',
            'email' => 'kike@gmail.com',
            'password' => bcrypt('kike')
        ]);
    }
}
