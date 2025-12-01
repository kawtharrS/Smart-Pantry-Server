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
        Schema::table('meal_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('recipe_id')->nullable()->after('id');

            $table->foreign('recipe_id')
                  ->references('id')
                  ->on('recipes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
