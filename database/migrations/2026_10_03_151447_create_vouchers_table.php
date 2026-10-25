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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            $table->string('code')->unique();

            $table->string('type')->default('birthday');

            $table->decimal('discount_percent', 5, 2)->default(10);

            $table->decimal('minimum_purchase', 15, 2)->default(0);

            $table->date('valid_from');

            $table->date('valid_until');

            $table->boolean('is_used')->default(false);

            $table->timestamp('used_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};