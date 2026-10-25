<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_fittings', function (Blueprint $table) {
            $table->time('booking_time')->nullable()->after('fitting_date');
            $table->string('fitting_type')->nullable()->after('booking_time');
            $table->text('notes')->nullable()->after('fitting_type');
            $table->string('status')->default('pending')->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('custom_fittings', function (Blueprint $table) {
            $table->dropColumn([
                'booking_time',
                'fitting_type',
                'notes',
                'status',
            ]);
        });
    }
};