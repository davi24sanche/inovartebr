<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detalle = new \App\Models\Detalle();
        $detalle->name='';
        $detalle->description='';
        $detalle->state='';
        $detalle->price = 20;
        //$detalle->tipo_id = ;

        $detalle->save();

    }
}
