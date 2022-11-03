<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_videos', function (Blueprint $table) {
            $table->id();
            $table->string('url_videos');
            $table->unsignedBigInteger('temas_id')->unsigned();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('temas_id')->references('id')->on('temas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_videos');
    }
}
