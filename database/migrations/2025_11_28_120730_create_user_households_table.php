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
        Schema::create('user_households', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->unsignedBigInteger("household_id");
            $table->foreign("household_id")->references("id")->on("households");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_households');
    }
};
