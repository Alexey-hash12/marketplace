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
        Schema::table('products', function (Blueprint $data) {
            $data->softDeletes();
        });

        Schema::table('users', function (Blueprint $data) {
            $data->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $data) {
            $data->dropSoftDeletes();
        });

        Schema::table('users', function (Blueprint $data) {
            $data->dropSoftDeletes();
        });
    }
};
