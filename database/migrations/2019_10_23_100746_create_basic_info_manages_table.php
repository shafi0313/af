<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicInfoManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_info_manages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('website_title','255');            
            $table->string('mobile','25');
            $table->string('email','225');
            $table->string('web_address','225');
            $table->string('address','225');
            $table->string('logo','225');           
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
        Schema::dropIfExists('basic_info_manages');
    }
}
