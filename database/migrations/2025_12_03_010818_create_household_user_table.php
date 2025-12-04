<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('household_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('household_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('household_id')->references('id')->on('households')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['household_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('household_user');
    }
};
