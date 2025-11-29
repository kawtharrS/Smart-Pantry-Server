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
        Schema::create('recipes_ingredients_table', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("recipe_id");
            $table->unsignedBigInteger("ingredient_id");
            $table->unsignedBigInteger("unit_id");
            $table->decimal("quantity");
            $table->foreign(columns: 'recipe_id')->references('id')->on('recipes');
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
        Schema::dropIfExists('recipes_ingredients_tabke');
    }
};
