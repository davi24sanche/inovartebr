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

        //detalle1
        $detalle = new \App\Models\Detalle();
        $detalle->name='detalle1';
        $detalle->description='Alquiler de casa';
        $detalle->state='Activo';
        $detalle->price = 100.000;
        $detalle->tipo_id = 3;
        $detalle->save();

        //detalle2
        $detalle = new \App\Models\Detalle();
        $detalle->name = 'detalle2';
        $detalle->description = 'Se alquila casa por tiempo indefinido';
        $detalle->state = 'Activo';
        $detalle->price = 200.000;
        $detalle->tipo_id = 1;
        $detalle->save();


        //detalle3
        $detalle = new \App\Models\Detalle();
        $detalle->name = 'detalle3';
        $detalle->description = 'Alquila casa por un periodo de un mes se cancela con antelación';
        $detalle->state = 'Activo';
        $detalle->price = 150.000;
        $detalle->tipo_id = 4;
        $detalle->save();



    }
}
