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
        Schema::create('pantries_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pantry_item_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("household_id");
            $table->decimal("quantity-change");
            $table->foreign(columns: 'pantry_item_id')->references('id')->on('pantries_items');
            $table->foreign(columns: 'user_id')->references('id')->on('users');
            $table->foreign(columns: 'household_id')->references('id')->on('households');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pantries_transactions');
    }
};
