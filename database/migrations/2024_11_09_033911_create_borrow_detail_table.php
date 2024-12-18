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
        Schema::create('borrow_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('history_id');
            $table->unsignedBigInteger('book_id');
            $table->string('book_name');
            $table->integer('amount')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('history_id')->references('id')->on('borrow_history')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_detail');
    }
};
