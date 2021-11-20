<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('series', function (Blueprint $table) {
            $table->dropIfExists('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Create 'series'
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('air_date')->nullable();
            $table->tinyInteger('series_qty')->unsigned();
            $table->tinyInteger('episode_qty')->unsigned()->nullable();
            $table->boolean('in_mcu')->default(0);
            $table->tinyInteger('mcu_phase_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }
}
