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
        Schema::create('income_warehouses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quantity');
            $table->float('meter_volume')->default(0);
            $table->unsignedBigInteger('pallet_count')->default(0);
            $table->string('status')->nullable();
            $table->dateTime('build_date')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_warehouses');
    }
};
