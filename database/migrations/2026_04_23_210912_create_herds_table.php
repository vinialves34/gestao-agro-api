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
        Schema::create('herds', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id')->unsigned();
            $table->integer('species_id')->unsigned();
            $table->integer('quantity');
            $table->string('purpose');
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herds');
    }
};
