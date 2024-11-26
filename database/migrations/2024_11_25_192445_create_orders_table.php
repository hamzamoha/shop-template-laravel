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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->enum('status', ['pending', 'processing', 'completed', 'shipped', 'canceled'])->default('pending');
            $table->decimal('total_amount', 10, 2);
            $table->foreignId('shipping_address_id')->constrained('addresses')->onDelete('cascade');
            $table->foreignId('billing_address_id')->constrained('addresses')->onDelete('cascade');
            $table->string('payment_method');
            $table->string('shipping_method');
            $table->decimal('shipping_cost', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes(); // For soft delete support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
