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
        Schema::create('meal_plans_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("meal_plan_id");
            $table->unsignedBigInteger("slot_id");
            $table->unsignedBigInteger("recipe_id");
            $table->string("day_of_week")->nullable();
            $table->foreign(columns: 'recipe_id')->references('id')->on('recipes');
            $table->foreign(columns: 'meal_plan_id')->references('id')->on('meal_plans');
            $table->foreign(columns: 'slot_id')->references('id')->on('slots');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_plans_items');
    }
};
