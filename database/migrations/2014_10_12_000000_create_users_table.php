<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('main_wallet');    
            $table->string('email')->unique();
            $table->string('user_id')->unique();
            $table->string('sponser_name');
            $table->string('mobile');            
            $table->string('gender');            
            $table->integer('status');            
            $table->string('password');
            $table->string('password_plain');   
            $table->string('address');                 
            $table->string('image');                 
            $table->string('country');           
            $table->date('birth_date');           
            $table->date('joining_date');           
            $table->date('active_date');           
            $table->integer('sponser_count');      
            $table->rememberToken();                    
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
        Schema::dropIfExists('users');
    }
}
