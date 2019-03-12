<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentarioEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario_entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_entrada_foro')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->text('comentario');
            $table->timestamps();
        });

        Schema::table('comentario_entradas', function (Blueprint $table) {
            $table->foreign('id_entrada_foro')->references('id')->on('entrada_foros');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentario_entradas');
    }
}
