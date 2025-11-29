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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("unit_id");
            $table->string("name");
            $table->decimal("caloriesPer100g")->nullable();
            $table->decimal("proteinPer100g")->nullable();
            $table->decimal("fatsPer100g")->nullable();
            $table->decimal("carbsPer100g")->nullable();
            $table->foreign(columns: 'unit_id')->references('id')->on('units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
