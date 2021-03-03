<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductoReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('producto_reserva',function (Blueprint $table){
        $table->increments('id');
        $table->unsignedInteger('reserva_id');
        $table->unsignedInteger('producto_id');
        $table->timestamps();
        $table->foreign('reserva_id')->references('id')->on('reservas');
        $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto_reserva', function (Blueprint $table) {
            $table->dropForeign('producto_reserva_reserva_id_foreign');
            $table->dropForeign('producto_reserva_producto_id_foreign');
        });

        Schema::dropIfExists('producto_reserva');
    }
}
