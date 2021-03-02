<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->decimal('CreationDate', 15, 2);
            $table->date('startDate');
            $table->date('finalDate');
            $table->string('reservecol');
            $table->integer('numPersons');
            $table->string('state');
            $table->decimal('adjustment', 15, 2);
            $table->decimal('subTotal', 15, 2);
            $table->decimal('priceServices', 15, 2);
            $table->decimal('tax', 15, 2);
            $table->decimal('total', 15, 2);
            $table->unsignedInteger('usuario_id');
            $table->timestamps();
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropForeign('reservas_usuario_id_foreign');
        });
        Schema::dropIfExists('reservas');
    }
}
