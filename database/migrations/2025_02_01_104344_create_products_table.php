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
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('category', ['WHITE', 'DARK', 'MILK', 'FRUITNNUT', 'STRAWBERRY', 'CARAMEL', 'VEGAN']);
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->decimal('price', 10);
            $table->decimal('discount_price', 10)->nullable();
            $table->string('currency', 3)->default('LKR');
            $table->integer('stock_quantity')->default(0);
            $table->enum('stock_status', ['In Stock', 'Out of Stock', 'Pre-Order']);
            $table->string('weight', 50)->nullable();
            $table->text('ingredients')->nullable();
            $table->text('allergy_info')->nullable();
            $table->text('storage_instructions')->nullable();
            $table->string('brand', 100)->nullable();
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
