<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCharactersRenameThumbUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rename character_thumb_url => thumb_url
        Schema::table('characters', function(Blueprint $table) {
            $table->renameColumn('character_thumb_url', 'thumb_url');
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
        Schema::table('characters', function(Blueprint $table) {
            $table->renameColumn('thumb_url', 'character_thumb_url');
        });
    }
}
