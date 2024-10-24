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
        // add column tag_id inside products table and product_id inside tags table
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id')->nullable();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('tag_id');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
    }
};
