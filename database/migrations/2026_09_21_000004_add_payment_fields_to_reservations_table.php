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
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('booking_code')->nullable()->unique()->after('id');
            $table->unsignedBigInteger('package_price')->default(0)->after('package_name');
            $table->unsignedInteger('dp_percentage')->default(30)->after('package_price');
            $table->unsignedBigInteger('dp_amount')->default(0)->after('dp_percentage');
            $table->unsignedBigInteger('remaining_amount')->default(0)->after('dp_amount');
            $table->string('payment_status')->default('unpaid')->after('status'); // unpaid, paid, cancelled
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('payment_proof')->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                'booking_code',
                'package_price',
                'dp_percentage',
                'dp_amount',
                'remaining_amount',
                'payment_status',
                'payment_method',
                'payment_proof',
            ]);
        });
    }
};

