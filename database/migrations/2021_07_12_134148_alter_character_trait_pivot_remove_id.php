<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCharacterTraitPivotRemoveId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('character_trait', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->primary(['trait_id','character_id']);
            $table->dropTimestamps();
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
        Schema::table('character_trait', function (Blueprint $table) {
            $table->dropPrimary();
            $table->id();
            $table->timestamps();
        });
    }
}
