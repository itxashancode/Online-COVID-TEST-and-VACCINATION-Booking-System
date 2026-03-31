<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create Vaccines Table Migration
 *
 * Stores vaccine information available at hospitals.
 * Admin can add/manage vaccines through the admin panel.
 */
return new class extends Migration
{
    /**
     * Run the migrations - Create vaccines table.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id(); // Primary key

            /**
             * Vaccine name - e.g., "Pfizer-BioNTech", "Moderna", "AstraZeneca"
             */
            $table->string('vaccine_name', 255);

            /**
             * Optional description of the vaccine, dosage information,
             * manufacturer, effectiveness stats, etc.
             */
            $table->text('description')->nullable();

            /**
             * Availability status:
             * - available:   Vaccine is in stock and can be administered
             * - unavailable: Out of stock or not currently offered
             */
            $table->enum('availability', ['available', 'unavailable'])->default('available');

            $table->timestamps(); // created_at, updated_at

            $table->index('availability');
        });
    }

    /**
     * Reverse the migrations - Drop vaccines table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
