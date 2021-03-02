<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductodetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productodetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('producto_id');
            $table->unsignedInteger('detalle_id');
            $table->timestamps();
            $table->foreign('producto_id')->references('id')->on('productos');
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
        Schema::table('productodetalles', function (Blueprint $table) {
            $table->dropForeign('productodetalles_producto_id_foreign');
        });
        Schema::table('productodetalles', function (Blueprint $table) {
            $table->dropForeign('productodetalles_detalle_id_foreign');
        });
        Schema::dropIfExists('productodetalles');
    }
}
