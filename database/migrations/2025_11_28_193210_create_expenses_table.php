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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("household_id");
            $table->unsignedBigInteger("currency_id");
            $table->unsignedBigInteger("category_id");
            $table->decimal("amount");
            $table->foreign(columns: 'household_id')->references('id')->on('households');
            $table->foreign(columns: 'currency_id')->references('id')->on('currencys');
            $table->foreign(columns: 'category_id')->references('id')->on('categorys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
