<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new \App\Models\Rol();
        $rol-> name = 'administrador';
        $rol->description = 'administrador';
        $rol->save();

        $rol = new \App\Models\Rol();
        $rol->name = 'cliente';
        $rol->description = 'cliente';
        $rol->save();

        $rol = new \App\Models\Rol();
        $rol->name = 'vendedor';
        $rol->description = 'vendedor';
        $rol->save();

    }
}
