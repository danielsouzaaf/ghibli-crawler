<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_movie', function (Blueprint $table) {
            $table->string('character_id');
            $table->string('movie_id');

            $table->foreign('character_id')
                ->references('id')
                ->on('characters');
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies');

            $table->unique(['character_id', 'movie_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_movie');
    }
}
