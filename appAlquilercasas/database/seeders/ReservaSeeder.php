<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Reserva1
        $reserva = new \App\Models\Reserva();
        $reserva->CreationDate = '2020-03-1';
        $reserva->user_id = 2;
        $reserva->name = 'reserva1';
        $reserva->description='En proceso';
        $reserva->state = 'Activo';
        $reserva->save();

        $reserva->detalles()->attach([1, 2]);

        $reserva->productos()->attach([1, 1]);


        //Reserva2
        $reserva = new \App\Models\Reserva();
        $reserva->CreationDate = '2020-02-12';
        $reserva->user_id = 1;
        $reserva->name = 'reserva2';
        $reserva->description = 'Cancelada';
        $reserva->state = 'Activo';
        $reserva->save();

        $reserva->detalles()->attach([1, 3]);

        $reserva->productos()->attach([1, 1]);


        //Reserva3
        $reserva = new \App\Models\Reserva();
        $reserva->CreationDate = '2020-02-28';
        $reserva->user_id = 3;
        $reserva->name = 'reserva3';
        $reserva->description = 'Pendiente';
        $reserva->state = 'Activo';
        $reserva->save();

        $reserva->detalles()->attach([1, 2]);

        $reserva->productos()->attach([1, 4]);




    }
}
