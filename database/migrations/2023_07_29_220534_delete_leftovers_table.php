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
        Schema::dropIfExists('leftOvers');

        Schema::table('warehouse_products', function (Blueprint $table) {
            $table->unsignedBigInteger('left_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warehouse_products', function (Blueprint $table) {
            $table->dropColumn('left_count');
        });
    }
};
