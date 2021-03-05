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
        $tipo->name='Mascotas';
        $tipo->description='Se aceptan Mascotas de cualquier tamaño';
        $tipo->save();

        //Categoria2
        $tipo = new \App\Models\Tipo();
        $tipo->name = 'Parqueo ';
        $tipo->description = 'Se cuenta con un parqueo privado para el vehiculo';
        $tipo->save();

        //Categoria3
        $tipo = new \App\Models\Tipo();
        $tipo->name = 'Parque Infantil';
        $tipo->description = 'Se encuentra cerca de las casas un parque infantil';
        $tipo->save();

        //Categoria4
        $tipo = new \App\Models\Tipo();
        $tipo->name = 'Seguridad';
        $tipo->description = 'Cada casa cuenta con camaras de vigilancia para mayor seguridad de las personas';
        $tipo->save();

       
    }
}
