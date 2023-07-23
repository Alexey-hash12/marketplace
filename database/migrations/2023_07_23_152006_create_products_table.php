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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instance_id')->nullable();
            $table->unsignedBigInteger('marketplace_type_id')->nullable();
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->double('price')->nullable();
            $table->json('sizes')->nullable();
            $table->json('colors')->nullable();
            $table->json('files')->nullable();
            $table->string('income_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
