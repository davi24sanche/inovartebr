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
            $table->date('CreationDate');
            $table->date('startDate')->nullable();
            $table->date('finalDate')->nullable();
            $table->string('reservecol')->nullable();
            $table->integer('numPersons')->nullable();
            $table->string('state');
            $table->decimal('adjustment', 15, 2)->nullable();
            $table->decimal('subTotal', 15, 2)->nullable();
            $table->decimal('priceServices', 15, 2)->nullable();
            $table->decimal('tax', 15, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
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
            $table->dropForeign('reservas_user_id_foreign');
        });
        Schema::dropIfExists('reservas');
    }
}
