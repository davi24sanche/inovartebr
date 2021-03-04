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
        $reserva->user_id = 4;
        $reserva->name = 'reserva1';
        $reserva->description='Reserva 1 en proceso';
        $reserva->state = 'Activo';

        

    }
}
