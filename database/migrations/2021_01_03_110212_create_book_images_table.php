<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_images', function (Blueprint $table) {
            $table->id();
            $table->string('src')->default('public/images/samples/bookIcon.jpg');
            $table->string('mime_type')->nullable();
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        /*
        Schema::create('book_images', function (Blueprint $table) {
            $table->('id');
            $table->string('title');
            $table->string('src');
            $table->string('mime_type')->nullable();
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('book_images');
    }
}
