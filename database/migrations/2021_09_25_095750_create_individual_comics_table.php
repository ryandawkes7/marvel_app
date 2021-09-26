<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualComicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comics', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('comic_book_id');
            $table->foreign('comic_book_id')->references('id')->on('comic_books')->onDelete('cascade');

            $table->text('title')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('issue_number');
            $table->unsignedBigInteger('volume_number')->nullable();

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
        Schema::dropIfExists('comics');
    }
}
