<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create 'characters' table
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('alias');
            $table->string('real_name')->nullable();
            $table->enum('sex', ['unknown', 'male', 'female', 'none'])->nullable();
            $table->text('character_thumb_url')->nullable();
            $table->enum('morality', ['hero', 'neutral', 'evil', 'anti-hero', 'anti-villian', 'unknown'])->default('unknown');
            $table->integer('type_id')->unsigned()->nullable();
            $table->integer('series_id')->unsigned()->nullable();
            $table->integer('movies_id')->unsigned()->nullable();
            $table->integer('comics_id')->unsigned()->nullable();
            $table->integer('teams_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop 'characters'
        Schema::dropIfExists('characters');
    }
}
