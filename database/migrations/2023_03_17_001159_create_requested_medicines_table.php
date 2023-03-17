<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_medicines', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('patient_fund_request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medicine_id')->constrained()->cascadeOnDelete();
            $table->string('medicine',191)->nullable();
            $table->decimal('requested_amt',8,2)->default(0);
            $table->decimal('approved_amt',8,2)->default(0);
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
        Schema::dropIfExists('requested_medicines');
    }
}
