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
            $table->id();
            $table->foreignId('image_id')->nullable()->constrained('book_images');
            $table->string('title');
            $table->string('author');
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
