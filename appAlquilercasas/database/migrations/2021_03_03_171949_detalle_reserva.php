<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class detalleReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_reserva', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('reserva_id');
            $table->unsignedInteger('detalle_id');
            $table->timestamps();
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->foreign('detalle_id')->references('id')->on('detalles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('detalle_reserva', function (Blueprint $table) {
            $table->dropForeign('detalle_reserva_reserva_id_foreign');
            
            $table->dropForeign('detalle_reserva_detalle_id_foreign');
        });
        Schema::dropIfExists('detalle_reserva');
    }
}
