<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create Hospitals Table Migration
 *
 * This migration creates the 'hospitals' table which stores
 * hospital registration details. Each hospital is linked to a user account
 * and has status that admin can approve/reject.
 *
 * Fields:
 * - user_id: Foreign key to users table (hospital owner/admin)
 * - hospital_name: Name of the hospital
 * - address, city, phone: Contact and location info
 * - description: Optional hospital description
 * - status: pending, approved, rejected
 */
return new class extends Migration
{
    /**
     * Run the migrations - Create hospitals table.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id(); // Primary key

            /**
             * Foreign key linking to users table.
             * Cascade delete: if user deleted, hospital record deleted too.
             */
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('hospital_name', 255); // Hospital's official name
            $table->string('address', 500);       // Physical address
            $table->string('city', 100);          // City location
            $table->string('phone', 20);          // Contact phone number

            /**
             * Optional description about hospital services,
             * facilities, COVID testing capacity, etc.
             */
            $table->text('description')->nullable();

            /**
             * Hospital registration status.
             * - pending:   Awaiting admin approval
             * - approved:  Admin has approved, hospital can now log in
             * - rejected:  Admin has rejected registration
             */
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps(); // created_at and updated_at timestamps

            /**
             * Optional: Indexes for faster queries
             */
            $table->index('status');
            $table->index('city');
        });
    }

    /**
     * Reverse the migrations - Drop hospitals table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
