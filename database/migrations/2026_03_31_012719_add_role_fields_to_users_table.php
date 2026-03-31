<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add Role Fields To Users Table Migration
 *
 * This migration adds additional fields to the existing users table
 * to support the COVID Booking System requirements:
 * - phone: Contact phone number
 * - address: Physical address
 * - city: City of residence
 * - user_type: Discriminator field (admin/hospital/patient) - optional as we use Spatie roles
 * - status: Account status (active/inactive/pending)
 *
 * Note: The users table already exists from Laravel Breeze.
 * We are only adding extra columns.
 */
return new class extends Migration
{
    /**
     * Run the migrations - Add columns to users table.
     *
     * @return void
     */
    public function up(): void
    {
        /**
         * Add phone column - nullable string for contact number
         */
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable()->after('email');
            }
        });

        /**
         * Add address column - nullable text for full address
         */
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }
        });

        /**
         * Add city column - nullable string
         */
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city', 100)->nullable()->after('address');
            }
        });

        /**
         * Add user_type enum - for quick filtering (optional, roles used primarily)
         */
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'user_type')) {
                $table->enum('user_type', ['admin', 'hospital', 'patient'])->default('patient')->after('city');
            }
        });

        /**
         * Add status enum - active, inactive, pending
         */
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['active', 'inactive', 'pending'])->default('active')->after('user_type');
            }
        });
    }

    /**
     * Reverse the migrations - Remove added columns.
     *
     * @return void
     */
    public function down(): void
    {
        /**
         * Drop columns in reverse order to avoid dependency issues.
         */
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('users', 'user_type')) {
                $table->dropColumn('user_type');
            }
            if (Schema::hasColumn('users', 'city')) {
                $table->dropColumn('city');
            }
            if (Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};
