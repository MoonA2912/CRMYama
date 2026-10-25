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
    Schema::create('custom_fittings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('customer_id')
            ->constrained('customers')
            ->cascadeOnDelete();

        $table->date('fitting_date');

        $table->string('height')->nullable();
        $table->string('weight')->nullable();

        $table->text('customer_needs')->nullable();
        $table->text('fitting_result')->nullable();
        $table->text('recommendation')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_fittings');
    }
};
