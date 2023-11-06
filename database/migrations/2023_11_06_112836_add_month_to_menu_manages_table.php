<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menu_manages', function (Blueprint $table) {
            $table->string('month')->after('id')->nullable();
            $table->string('year')->after('id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_manages', function (Blueprint $table) {
            $table->dropColumn(['month','year']);
        });
    }
};
