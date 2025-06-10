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
        Schema::create('price_history', function (Blueprint $table) {
            $table->uuid()->primary()->unique();
            $table->uuid('product_id');
            $table->foreign('product_id')->references('uuid')->on('products')->onDelete('cascade');
            $table->uuid('customers_id');
            $table->foreign('customers_id')->references('uuid')->on('customers')->onDelete('cascade');
            $table->integer('old_price');
            $table->integer('new_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_history');
    }
};
