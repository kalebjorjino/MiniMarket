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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('quantity')->nullable();
            $table->boolean('inPayment')->default(false); // if paid 
            $table->timestamps();
            // $table->string('notes')->nullable();
            // $table->string('size')->nullable();
            // $table->string('color')->nullable();
            // $table->string('paper')->nullable();
            // $table->string('print_color')->nullable();
            // $table->longText('upload_design')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
