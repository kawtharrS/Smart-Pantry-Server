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
        Schema::create('pantries_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("household_id");
            $table->unsignedBigInteger("ingredient_id");
            $table->unsignedBigInteger("unit_id");
            $table->decimal("quantity");
            $table->string("location")->nullable();
            $table->date("expiry_date");
            $table->foreign(columns: 'household_id')->references('id')->on('households');
            $table->foreign(columns: 'ingredient_id')->references('id')->on('ingredients');
            $table->foreign(columns: 'unit_id')->references('id')->on('units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pantries_items');
    }
};
