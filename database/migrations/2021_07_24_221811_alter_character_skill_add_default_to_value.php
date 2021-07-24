<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCharacterSkillAddDefaultToValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('character_skill', function (Blueprint $table) {
            $table->unsignedInteger('value')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('character_skill', function (Blueprint $table) {
            $table->unsignedBigInteger('value')->change();
        });
    }
}
