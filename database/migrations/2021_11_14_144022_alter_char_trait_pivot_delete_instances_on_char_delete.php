<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCharTraitPivotDeleteInstancesOnCharDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('character_trait', function (Blueprint $table) {
            $table->dropForeign('character_trait_character_id_foreign');
            $table->foreign('character_id')->references('id')->on('characters')->onDelete('CASCADE')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('character_trait', function (Blueprint $table) {
            $table->dropForeign('character_trait_character_id_foreign');
            $table->foreign('character_id')->references('id')->on('characters')->change();
        });
    }
}
