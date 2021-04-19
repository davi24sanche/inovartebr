<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Categoria1
        $tipo = new \App\Models\Tipo();
        $tipo->name = 'Servicio tipo P';
        $tipo->description = 'Servicio para productos';
        $tipo->save();

        //Categoria2
        $tipo = new \App\Models\Tipo();
        $tipo->name = 'Caracteristica';
        $tipo->description = 'Caracteristicas generales que sirven para cualquier atributo';
        $tipo->save();

        //Categoria3
        $tipo = new \App\Models\Tipo();
        $tipo->name = 'Servicio tipo R';
        $tipo->description = 'Servicio para reservas';
        $tipo->save();

        //Categoria4
        $tipo = new \App\Models\Tipo();
        $tipo->name = 'Adicional';
        $tipo->description = 'Se usa para agregar detalles adicionales';
        $tipo->save();


    }
}
