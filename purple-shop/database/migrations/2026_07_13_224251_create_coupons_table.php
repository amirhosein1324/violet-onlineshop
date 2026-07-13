<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['fixed', 'percent']); // 'fixed' ($10 off) or 'percent' (10% off)
            $table->decimal('value', 10, 2); // e.g., 10.00 or 15.00 (%)
            $table->decimal('min_order_amount', 10, 2)->default(0);
            $table->integer('usage_limit')->nullable(); // max times coupon can be used
            $table->integer('used_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};