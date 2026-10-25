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
        Schema::table('order_items', function (Blueprint $table) {
            $table->boolean('print_custom')
                ->default(false)
                ->after('price');

            $table->decimal('print_price', 12, 2)
                ->default(0)
                ->after('print_custom');

            $table->string('design_image')
                ->nullable()
                ->after('print_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn([
                'print_custom',
                'print_price',
                'design_image',
            ]);
        });
    }
};