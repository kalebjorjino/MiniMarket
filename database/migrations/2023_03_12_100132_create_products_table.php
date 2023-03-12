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
            $table->string('folder')->nullable(); 
            $table->string('category_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->longText('description')->nullable();
            $table->longText('price')->nullable();
            $table->longText('preview_image')->nullable(); // main preview
            $table->longText('product_sample')->nullable();
            $table->boolean('hidden')->default(true);
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
