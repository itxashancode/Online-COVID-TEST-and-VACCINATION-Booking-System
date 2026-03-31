<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create Vaccination Records Table Migration
 *
 * Stores records of vaccinations given to patients.
 * Each record links an appointment (vaccination type) with a vaccine and dose.
 * Created when hospital completes a vaccination appointment.
 */
return new class extends Migration
{
    /**
     * Run the migrations - Create vaccination_records table.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('vaccination_records', function (Blueprint $table) {
            $table->id(); // Primary key

            /**
             * Foreign key to the appointment that resulted in this vaccination.
             * One vaccination record per appointment.
             */
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');

            /**
             * Foreign key to patient (users table).
             * Duplicate of appointment->patient_id for quick querying.
             */
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');

            /**
             * Foreign key to hospital (hospitals table).
             * Duplicate of appointment->hospital_id.
             */
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');

            /**
             * Foreign key to vaccine used.
             * References the vaccines table.
             */
            $table->foreignId('vaccine_id')->constrained()->onDelete('cascade');

            /**
             * Dose number/type:
             * - first:   First dose of the vaccine series
             * - second:  Second dose (for two-dose vaccines)
             * - booster: Booster/third dose for enhanced protection
             */
            $table->enum('dose', ['first', 'second', 'booster']);

            /**
             * Date when the vaccine was administered.
             * Important for determining when next dose is due.
             */
            $table->date('vaccination_date');

            /**
             * Vaccination status:
             * - completed: Vaccine successfully administered
             * - pending:   Record created but vaccination not yet done (unlikely)
             */
            $table->enum('status', ['completed', 'pending'])->default('completed');

            $table->timestamps(); // created_at, updated_at

            /**
             * Indexes for performance:
             * - Unique constraint: one vaccination record per appointment
             * - Indexes for patient history and hospital records
             */
            $table->unique('appointment_id'); // One record per vaccination appointment
            $table->index(['patient_id', 'vaccination_date']);
            $table->index('hospital_id');
            $table->index('vaccine_id');
        });
    }

    /**
     * Reverse the migrations - Drop vaccination_records table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccination_records');
    }
};
