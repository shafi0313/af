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
            $table->date('recept_date')->nullable()->after('id');
        });
        Schema::table('fund_requetions', function (Blueprint $table) {
            $table->date('date')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_manages', function (Blueprint $table) {
            $table->dropColumn('recept_date');
        });
        Schema::table('fund_requetions', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
};
