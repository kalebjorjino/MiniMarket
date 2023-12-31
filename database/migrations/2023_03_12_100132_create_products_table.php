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
            $table->id();
            $table->string('title')->nullable(); 
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('stocks')->nullable();
            $table->integer('stock_alert')->nullable();

            $table->longText('product_cover')->nullable(); // main preview
            // $table->longText('product_images')->nullable(); // unused

            $table->boolean('featured')->default(false)->nullable();
            $table->boolean('status')->default(true)->nullable();

            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
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
