<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCharactersDropIdColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop unnecessary id columns 
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn('series_id');
            $table->dropColumn('movies_id');
            $table->dropColumn('comics_id');
            $table->dropColumn('teams_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('characters', function (Blueprint $table) {
            $table->integer('series_id', 0, 1);
            $table->integer('movies_id', 0, 1);
            $table->integer('comics_id', 0, 1);
            $table->integer('teams_id', 0, 1);
        });
    }
}
