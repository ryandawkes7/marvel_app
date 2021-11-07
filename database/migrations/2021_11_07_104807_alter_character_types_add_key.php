<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class AlterCharacterTypesAddKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('character_types', function (Blueprint $table) {
            $table->string('key')->after('id');
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
            $table->dropColumn('key');
        });
    }
}
