<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('img_id')->default(1)->references('id')->on('book_images');
            $table->string('img_src')->default('bookIcon.jpg');
            $table->string('title');
            $table->string('author');
            $table->string('description')->default('Brak.');
            $table->timestamps();
        });
        /*
        Schema::table('others', function(Blueprint $table){
        $table->foreign('photo_id')->references('id')->on('photos');
        });
         * 
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
