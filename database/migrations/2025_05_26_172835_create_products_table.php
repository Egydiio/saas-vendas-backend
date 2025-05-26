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
            $table->uuid()->unique()->primary();
            $table->uuid('tenant_id');
            $table->foreign('tenant_id')->references('uuid')->on('tenants')->onDelete('cascade');
            $table->string('name');
            $table->integer('price')->nullable()->unsigned();
            $table->integer('stock')->nullable()->unsigned();
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
