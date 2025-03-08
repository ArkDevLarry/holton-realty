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
        Schema::create('shortlets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->string('location');
            $table->string('link');
            $table->string('fees');
            $table->string('total');
            $table->string('uniqId');
            $table->string('description');
            $table->text('features');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shortlets');
    }
};
