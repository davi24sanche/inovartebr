<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $objUsuario = \App\Models\User::create([
        'name'=>'admin1',
        'email' =>'admin1@gmail.com',
        'password' => ('123456'),
         'state' => 'Activo',
         'rol_id' => 1

        ]);
        $objUsuario->save();

        //2
        $objUsuario = \App\Models\User::create([
            'name' => 'vendedor1',
            'email' => 'vendedor1@gmail.com',
            'password' => ('123456'),
            'state' => 'Activo',
            'rol_id' => 3

        ]);
        $objUsuario->save();

        //3
        $objUsuario = \App\Models\User::create([
            'name' => 'cliente1',
            'email' => 'cliente1@gmail.com',
            'password' => ('123456'),
            'state' => 'Activo',
            'rol_id' => 2

        ]);
        $objUsuario->save();

    }
}
