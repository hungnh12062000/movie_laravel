<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100); //varchar(100)
            $table->longText('description')->nullable();
            $table->integer('status');
            $table->string('image', 255);
            $table->string('slug', 255);
            $table->integer('category_id');
            $table->integer('genre_id');
            $table->integer('country_id');
            $table->string('name_eng', 255);
            $table->integer('resolution')->default(0);
            $table->integer('cc')->default(0);
            $table->timestamps();
            $table->string('year', 20)->nullable();
            $table->string('time', 50)->nullable();
            $table->text('tags')->nullable();
            $table->integer('movie_hot');
            $table->integer('topview')->nullable();
            $table->string('trailer', 200)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
