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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Discount name
            $table->enum('type', ['flat', 'percentage']); // Discount type
            $table->decimal('value', 8, 2); // Discount value (e.g., 20 for 20% or $20)
            $table->string('code')->nullable(); // Optional coupon code
            $table->dateTime('starts_at')->nullable(); // Start date
            $table->dateTime('ends_at')->nullable(); // End date
            $table->timestamps();
        });
        Schema::create('discount_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_product');
        Schema::dropIfExists('discounts');
    }
};
