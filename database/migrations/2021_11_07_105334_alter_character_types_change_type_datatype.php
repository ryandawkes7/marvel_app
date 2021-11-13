<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class AlterCharacterTypesChangeTypeDatatype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('character_types', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('character_types', function (Blueprint $table) {
            $table->string('type')->after('key');
        });

        Artisan::call('db:seed', ['--class' => 'CharacterTypesSeeder']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('character_types', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->enum('type', ['human', 'robot', 'unknown']);
        });
    }
}
