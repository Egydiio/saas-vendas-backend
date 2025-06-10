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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->uuid()->unique()->primary();
            $table->uuid('sale_id');
            $table->foreign('sale_id')->references('uuid')->on('sales')->onDelete('cascade');
            $table->uuid('product_id');
            $table->foreign('product_id')->references('uuid')->on('products')->onDelete('cascade');
            $table->integer('quantity')->unsigned();
            $table->integer('unit_price')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale__items');
    }
};
