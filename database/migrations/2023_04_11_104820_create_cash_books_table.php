<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('student|patient')->index();
            $table->boolean('user_type')->comment('1=student,2=patient,3=bank');
            $table->foreignId('cash_book_office_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('tran_id', 64)->nullable()->index();
            $table->string('narration', 191)->nullable();
            $table->date('date');
            $table->double('debit', 8, 2)->default(0)->nullable();
            $table->double('credit', 8, 2)->default(0)->nullable();
            $table->string('payment_by', 191)->nullable();
            $table->boolean('is_post')->default(0);
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
        Schema::dropIfExists('cash_books');
    }
}
