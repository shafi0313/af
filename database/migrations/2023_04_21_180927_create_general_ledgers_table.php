<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('student|patient')->index();
            $table->boolean('user_type')->comment('1=student,2=patient,3=bank');
            $table->string('tran_id', 64)->nullable()->index();
            $table->string('narration', 191)->nullable();
            $table->date('date');
            $table->string('source');
            // $table->string('chart_id');
            // $table->string('gst_code');
            // $table->tinyInteger('ac_type')->comment('1=Debit,2=Credit');
            // $table->tinyInteger('amt_type')->comment('1=Debit,2=Credit');
            $table->double('debit', 8, 2)->default(0)->nullable();
            $table->double('credit', 8, 2)->default(0)->nullable();
            // $table->double('gst_accrued_debit', 8, 2)->nullable();
            // $table->double('gst_accrued_credit', 8, 2)->nullable();
            // $table->double('gst_cash_debit', 8, 2)->nullable();
            // $table->double('gst_cash_credit', 8, 2)->nullable();
            // $table->double('net_amount_debit', 8, 2)->nullable();
            // $table->double('net_amount_credit', 8, 2)->nullable();
            // $table->double('accumulated', 8, 2)->nullable();
            // $table->boolean('is_save')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_ledgers');
    }
}
