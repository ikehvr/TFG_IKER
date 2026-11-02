<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'profile_photo')) {
                $table->string('profile_photo')->nullable()->after('rol');
            }
        });

        Schema::table('reservas', function (Blueprint $table) {
            if (!Schema::hasColumn('reservas', 'payment_method')) {
                $table->string('payment_method', 30)->nullable()->after('stripe_payment_intent');
            }

            if (!Schema::hasColumn('reservas', 'payment_last4')) {
                $table->string('payment_last4', 4)->nullable()->after('payment_method');
            }

            if (!Schema::hasColumn('reservas', 'receipt_number')) {
                $table->string('receipt_number', 40)->nullable()->after('payment_last4');
            }

            if (!Schema::hasColumn('reservas', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('receipt_number');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            foreach (['payment_method', 'payment_last4', 'receipt_number', 'paid_at'] as $column) {
                if (Schema::hasColumn('reservas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'profile_photo')) {
                $table->dropColumn('profile_photo');
            }
        });
    }
};
