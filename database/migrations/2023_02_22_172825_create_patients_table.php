<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->string('f_name',191);
            $table->string('m_name',191);
            $table->string('phone',30)->nullable();
            $table->string('e_phone',30)->nullable();
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('upazila_id');
            $table->string('post',191);
            $table->string('village',191);
            $table->string('finance',500);
            $table->string('hospital',191);
            $table->string('doctor',191);
            $table->decimal('total_income',12,2);
            $table->string('patient_img',64);
            $table->string('nid',64);
            $table->string('sonod',64)->nullable();
            $table->string('prescription',64);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('patients');
    }
}
