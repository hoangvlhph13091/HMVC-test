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
        Schema::table('borrow_detail', function (Blueprint $table) {
            $table->integer('return_status')->after('status')->nullable();
            $table->dateTime('return_date')->after('return_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrow_detail', function (Blueprint $table) {
            $table->dropColumn('return_status');
            $table->dropColumn('return_date');
        });
    }
};
