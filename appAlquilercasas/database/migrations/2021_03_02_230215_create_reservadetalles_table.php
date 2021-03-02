<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservadetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservadetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reserva_id');
            $table->unsignedInteger('detalle_id');
            $table->timestamps();
            $table->foreign('detalle_id')->references('id')->on('detalles');
            $table->foreign('reserva_id')->references('id')->on('reservas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('reservadetalles', function (Blueprint $table) {
            $table->dropForeign('reservadetalles_detalle_id_foreign');
        });

        Schema::table('reservadetalles', function (Blueprint $table) {
            $table->dropForeign('reservadetalles_reserva_id_foreign');
        });
        Schema::dropIfExists('reservadetalles');
    }
}
