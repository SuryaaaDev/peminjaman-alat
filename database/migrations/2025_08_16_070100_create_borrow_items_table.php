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
        Schema::create('borrow_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('borrow_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('borrow_id')->references('id')->on('borrows')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_items');
    }
};
