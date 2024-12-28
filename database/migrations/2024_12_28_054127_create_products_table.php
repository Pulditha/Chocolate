<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name', 255); // Product name
            $table->enum('category', ['WHITE', 'DARK', 'MILK', 'FRUITNNUT', 'STRAWBERRY', 'CARAMEL', 'VEGAN']); // Categories
            $table->text('description')->nullable(); // Detailed description
            $table->json('images')->nullable(); // JSON array for image paths
            $table->decimal('price', 10, 2); // Selling price
            $table->decimal('discount_price', 10, 2)->nullable(); // Optional discounted price
            $table->string('currency', 3)->default('LKR'); // Currency
            $table->integer('stock_quantity')->default(0); // Stock quantity
            $table->enum('stock_status', ['In Stock', 'Out of Stock', 'Pre-Order']); // Stock status
            $table->string('weight', 50)->nullable(); // Weight of the product
            $table->text('ingredients')->nullable(); // Ingredients
            $table->text('allergy_info')->nullable(); // Allergy warnings
            $table->text('storage_instructions')->nullable(); // Storage instructions
            $table->string('brand', 100)->nullable(); // Brand name
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
