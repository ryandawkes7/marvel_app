<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_shows', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedMediumInteger('episode_count');
            $table->unsignedSmallInteger('season_count');
            $table->text('logo_url');
            $table->text('description')->nullable()->default(null);
            $table->boolean('in_mcu')->default(0);
            $table->unsignedBigInteger('mcu_phase_id')->nullable()->default(null);
            $table->date('release_date')->nullable();
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
        Schema::dropIfExists('tv_shows');
    }
}
