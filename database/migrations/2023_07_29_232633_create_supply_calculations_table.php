<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**£
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supply_calculations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('user_id');
            $table->float('speed')->comment('Скороть на тот момент')->default(0);
            $table->float('leftovers')->comment('Остатки на тот момент')->default(0);
            $table->unsignedBigInteger('count_products');
            $table->unsignedBigInteger('count_days');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_calculations');
    }
};
