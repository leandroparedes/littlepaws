<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_compra')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->integer('cantidad');
            $table->integer('subtotal');
            $table->timestamps();
        });

        Schema::table('compra_productos', function (Blueprint $table) {
            $table->foreign('id_compra')->references('id')->on('compras');
            $table->foreign('id_producto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_productos');
    }
}
