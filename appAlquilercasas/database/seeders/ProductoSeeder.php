<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Instancia de Producto 1
        $producto = new \App\Models\Producto();
        $producto->name = 'Vila Linda Vista';
        $producto->description='Cuenta con 3 habitaciones muy comoda, cuenta con dos baños uno que se
        encuentra dentro de la habitación principal y el otro baño se ubica en pasillo, la casa cuenta con una excelente iluminación';
        $producto->state='disponible';
        $producto->price = 110.00;
        $producto->save();

        //Instancia de Producto 2
        $producto = new \App\Models\Producto();
        $producto->name = 'Los Robles';
        $producto->description = 'Tiene un patio muy amplio con una buena zona verde en caso de tener mascotas, cuenta con una puerta trasera que comunica el patio, una cocina espaciosa,tiene un garaje.La decoracion de la casa es muy sobria';
        $producto->state = 'disponible';
        $producto->price = 140.00;
        $producto->save();

        //Instancia de Producto 3
        $producto = new \App\Models\Producto();
        $producto->name = 'La Escondida';
        $producto->description = 'Se ubica en una zona muy tranquila, alrededor de la casa tiene arboles, cuenta con dos habitaciones una grande y una mediada que tiene dos camas cada cuarto tiene un baño pequeño pero comodo, una sala muy apmlia';
        $producto->state = 'disponible';
        $producto->price = 120.00;
        $producto->save();

        //Instancia de Producto 4
        $producto = new \App\Models\Producto();
        $producto->name = 'Vista Pradera';
        $producto->description = 'La casa es de dos plantas, tiene una escalera para ir a la segunda planta en donde se ubican las habitaciones y los baños, en la parte de abajo se encuentra la sala, cocina y una puerta que da directo al jardin';
        $producto->state = 'disponible';
        $producto->price = 190.00;
        $producto->save();

    }



    }

