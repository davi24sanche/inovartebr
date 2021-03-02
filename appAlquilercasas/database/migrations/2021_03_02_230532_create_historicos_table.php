<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('monto', 15, 2);
            $table->date('payDay');
            $table->string('method');
            $table->string('description');
            $table->string('locationFact');
            $table->unsignedInteger('reserva_id');
            $table->timestamps();
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
        Schema::table('historicos', function (Blueprint $table) {
            $table->dropForeign('historicos_reserva_id_foreign');
        });
        Schema::dropIfExists('historicos');
    }
}
