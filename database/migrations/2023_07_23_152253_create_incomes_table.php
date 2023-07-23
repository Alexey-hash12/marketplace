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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marketplace_id');
            $table->string('period')->nullable();
            $table->unsignedBigInteger('days')->default(0);
            $table->float('min_stocks')->default(0);
            $table->boolean('on_the_way')->default(false);
            $table->boolean('box_qr')->default(false);
            $table->unsignedBigInteger('count_articles')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
