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
        Schema::create('book_import_receipt_detail', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_unique_id', 32);
            $table->unsignedBigInteger('book_id');
            $table->timestamps();

            $table->foreign('receipt_unique_id')->references('receipt_unique_id')->on('book_import_receipt')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('book_id')->references('id')->on('books')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_import_receipt_detail');
    }
};
