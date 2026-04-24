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
        Schema::create('rural_producers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf_cnpj')->unique();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rural_producers');
    }
};
