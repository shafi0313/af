<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide_manages', function (Blueprint $table) {
            $table->increments('id');         
            $table->string('title','250')->nullable();
            $table->string('short_details','250')->nullable();
            $table->longText('long_details')->nullable();
            $table->string('image','225');           
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
        Schema::dropIfExists('slide_manages');
    }
}
