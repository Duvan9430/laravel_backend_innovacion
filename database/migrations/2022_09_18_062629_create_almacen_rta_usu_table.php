<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenRtaUsuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacen_rta_usu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->unsignedBigInteger('preguntas_id')->unsigned()->index();
            $table->unsignedBigInteger('respuestas_id')->unsigned()->index();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('preguntas_id')->references('id')->on('preguntas');
            $table->foreign('respuestas_id')->references('id')->on('respuestas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('almacen_rta_usu');
    }
}
