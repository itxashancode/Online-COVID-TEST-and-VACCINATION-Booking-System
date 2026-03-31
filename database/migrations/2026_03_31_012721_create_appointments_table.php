<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create Appointments Table Migration
 *
 * This is a core table that links patients (users) with hospitals.
 * Each appointment represents a booking for either a COVID test or vaccination.
 * Status flows: pending → approved/rejected → completed
 */
return new class extends Migration
{
    /**
     * Run the migrations - Create appointments table.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id(); // Primary key

            /**
             * Foreign key to patients (users table).
             * The user who booked this appointment.
             * Cascade delete: if patient account deleted, remove their appointments.
             */
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');

            /**
             * Foreign key to hospitals table.
             * The hospital where appointment is booked.
             * Cascade delete: if hospital deleted, remove its appointments.
             */
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');

            /**
             * Type of appointment:
             * - covid_test:  COVID-19 test booking
             * - vaccination: Vaccine administration booking
             */
            $table->enum('appointment_type', ['covid_test', 'vaccination']);

            /**
             * Date of the appointment.
             * The day patient should visit the hospital.
             */
            $table->date('appointment_date');

            /**
             * Optional appointment time (e.g., "10:30", "14:00").
             * Nullable if hospital manages scheduling separately.
             */
            $table->time('appointment_time')->nullable();

            /**
             * Appointment status:
             * - pending:   Request submitted, awaiting hospital approval
             * - approved:  Hospital approved the appointment
             * - rejected:  Hospital rejected the appointment
             * - completed: Appointment finished, result/status updated
             */
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');

            /**
             * Additional notes from patient or hospital.
             * Could include symptoms, preferences, special requests.
             */
            $table->text('notes')->nullable();

            $table->timestamps(); // created_at, updated_at

            /**
             * Indexes for improving query performance:
             * - Composite index on patient_id + status for patient's dashboard
             * - Composite index on hospital_id + status for hospital's queue
             * - Index on appointment_date for date-based filtering
             * - Index on appointment_type to filter by test/vaccine
             */
            $table->index(['patient_id', 'status']);
            $table->index(['hospital_id', 'status']);
            $table->index('appointment_date');
            $table->index('appointment_type');
        });
    }

    /**
     * Reverse the migrations - Drop appointments table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
