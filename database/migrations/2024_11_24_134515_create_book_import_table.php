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
        Schema::create('book_import_receipt', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_unique_id');
            $table->string('receipt_date');
            $table->string('receipt_person');
            $table->string('receipt_source')->nullable();
            $table->string('receipt_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_import_receipt');
    }
};
