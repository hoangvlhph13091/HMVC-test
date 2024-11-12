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
        Schema::create('borrow_history', function (Blueprint $table) {
            $table->id();
            $table->string('reader_name');
            $table->string('reader_id')->nullable();
            $table->string('reader_phone');
            $table->string('reader_address');
            $table->string('reader_status');
            $table->string('reader_fee')->nullable();
            $table->dateTime('borrow_date')->default(now());
            $table->tinyInteger('borrow_status')->default(1);
            $table->dateTime('return_date')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_history');
    }
};
