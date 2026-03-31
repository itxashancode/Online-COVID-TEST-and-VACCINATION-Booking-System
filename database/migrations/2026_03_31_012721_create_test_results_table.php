<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create Test Results Table Migration
 *
 * Stores COVID-19 test results for appointments.
 * Each result is linked to an appointment, patient, and hospital.
 * Hospitals update this when test results are available.
 */
return new class extends Migration
{
    /**
     * Run the migrations - Create test_results table.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id(); // Primary key

            /**
             * Foreign key to appointments table.
             * Each test result is associated with one appointment.
             * Cascade delete: if appointment deleted, remove result.
             */
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');

            /**
             * Foreign key to patient (users table).
             * Storing patient_id here allows quick queries without joining appointments.
             */
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');

            /**
             * Foreign key to hospital (hospitals table).
             * Stored for quick queries by hospital.
             */
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');

            /**
             * Test result outcome:
             * - positive: Patient tested positive for COVID-19
             * - negative: Patient tested negative
             * - pending:  Test conducted, result awaited
             */
            $table->enum('result', ['positive', 'negative', 'pending'])->default('pending');

            /**
             * Doctor's notes about the test result.
             * Could include recommendations, observations, next steps.
             */
            $table->text('doctor_notes')->nullable();

            /**
             * Date when the result was recorded/entered in system.
             * May differ from appointment date if test takes time.
             */
            $table->date('result_date')->nullable();

            $table->timestamps(); // created_at, updated_at

            /**
             * Indexes for performance:
             * - Quick lookup by appointment
             * - Patient's result history
             * - Hospital's result records
             */
            $table->unique('appointment_id'); // One result per appointment
            $table->index('patient_id');
            $table->index('hospital_id');
            $table->index('result');
            $table->index('result_date');
        });
    }

    /**
     * Reverse the migrations - Drop test_results table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
