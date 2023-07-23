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
        Schema::create('income_warehouse_products', function (Blueprint $table) {
            $table->id();
            $table->string('system_id')->nullable();
            $table->string('uuid')->nullable();
            $table->unsignedBigInteger('income_warehouse_id')->nullable();
            $table->string('barcode');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_warehouse_products');
    }
};
