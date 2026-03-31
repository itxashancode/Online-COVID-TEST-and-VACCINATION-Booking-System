<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Vaccine;
use App\Models\Appointment;
use App\Models\VaccinationRecord;

/**
 * DemoDataSeeder
 *
 * Creates sample data for testing the COVID Booking System:
 * - Hospital user with approved hospital profile
 * - Patient user
 * - Vaccine options
 * - Sample appointments with results/vaccination records
 *
 * Usage: php artisan db:seed --class=DemoDataSeeder
 */
class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->info('🌱 Creating demo data for COVID Booking System...');

        // ============ 1. CREATE HOSPITAL USER ============
        $this->command->info('📦 Creating Hospital...');

        $hospitalUser = User::firstOrCreate(
            ['email' => 'hospital@demo.com'],
            [
                'name' => 'City General Hospital',
                'password' => Hash::make('password'),
                'user_type' => 'hospital',
                'status' => 'active',
                'phone' => '+1 234 567 8900',
                'address' => '123 Healthcare Avenue',
                'city' => 'New York',
            ]
        );

        // Assign hospital role
        $hospitalUser->assignRole('hospital');

        // Create hospital profile
        $hospital = Hospital::firstOrCreate(
            ['user_id' => $hospitalUser->id],
            [
                'hospital_name' => 'City General Hospital',
                'address' => '123 Healthcare Avenue, New York',
                'city' => 'New York',
                'phone' => '+1 234 567 8900',
                'description' => 'Leading healthcare provider with COVID-19 testing and vaccination services.',
                'status' => 'approved', // Pre-approved for testing
            ]
        );

        $this->command->info('✅ Hospital created: hospital@demo.com / password');

        // ============ 2. CREATE PATIENT USER ============
        $this->command->info('📦 Creating Patient...');

        $patientUser = User::firstOrCreate(
            ['email' => 'patient@demo.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'user_type' => 'patient',
                'status' => 'active',
                'phone' => '+1 987 654 3210',
                'address' => '456 Patient Street',
                'city' => 'Brooklyn',
            ]
        );

        // Assign patient role
        $patientUser->assignRole('patient');

        $this->command->info('✅ Patient created: patient@demo.com / password');

        // ============ 3. CREATE VACCINES ============
        $this->command->info('📦 Creating Vaccines...');

        $vaccines = [
            [
                'vaccine_name' => 'Pfizer-BioNTech',
                'description' => 'mRNA vaccine, 2 doses required, 95% effective',
                'availability' => 'available',
            ],
            [
                'vaccine_name' => 'Moderna',
                'description' => 'mRNA vaccine, 2 doses required, 94% effective',
                'availability' => 'available',
            ],
            [
                'vaccine_name' => 'Johnson & Johnson',
                'description' => 'Single dose vaccine, 66% effective',
                'availability' => 'available',
            ],
            [
                'vaccine_name' => 'AstraZeneca',
                'description' => 'Vector vaccine, 2 doses required',
                'availability' => 'unavailable', // Out of stock example
            ],
        ];

        foreach ($vaccines as $vaccineData) {
            Vaccine::firstOrCreate(
                ['vaccine_name' => $vaccineData['vaccine_name']],
                $vaccineData
            );
        }

        $this->command->info('✅ ' . count($vaccines) . ' vaccines created');

        // ============ 4. CREATE SAMPLE APPOINTMENT (COVID TEST) ============
        $this->command->info('📦 Creating sample COVID test appointment...');

        $covidAppointment = Appointment::create([
            'patient_id' => $patientUser->id,
            'hospital_id' => $hospital->id,
            'appointment_type' => 'covid_test',
            'appointment_date' => date('Y-m-d', strtotime('-3 days')),
            'appointment_time' => '10:30:00',
            'status' => 'completed',
            'notes' => 'Routine checkup',
        ]);

        // Create test result for this appointment
        TestResult::create([
            'appointment_id' => $covidAppointment->id,
            'patient_id' => $patientUser->id,
            'hospital_id' => $hospital->id,
            'result' => 'negative',
            'doctor_notes' => 'Test result negative. Continue following safety protocols.',
            'result_date' => date('Y-m-d', strtotime('-3 days')),
        ]);

        $this->command->info('✅ COVID test appointment created with negative result');

        // ============ 5. CREATE SAMPLE VACCINATION ============
        $this->command->info('📦 Creating sample vaccination record...');

        $vaccine = Vaccine::where('vaccine_name', 'Pfizer-BioNTech')->first();

        $vaccineAppointment = Appointment::create([
            'patient_id' => $patientUser->id,
            'hospital_id' => $hospital->id,
            'appointment_type' => 'vaccination',
            'appointment_date' => date('Y-m-d', strtotime('-30 days')),
            'appointment_time' => '14:00:00',
            'status' => 'completed',
            'notes' => 'First dose of Pfizer vaccine',
        ]);

        // Create vaccination record
        VaccinationRecord::create([
            'appointment_id' => $vaccineAppointment->id,
            'patient_id' => $patientUser->id,
            'hospital_id' => $hospital->id,
            'vaccine_id' => $vaccine->id,
            'dose' => 'first',
            'vaccination_date' => date('Y-m-d', strtotime('-30 days')),
            'status' => 'completed',
        ]);

        $this->command->info('✅ Vaccination appointment created with first dose');

        // ============ 6. CREATE PENDING APPOINTMENT ============
        $this->command->info('📦 Creating pending appointment...');

        Appointment::create([
            'patient_id' => $patientUser->id,
            'hospital_id' => $hospital->id,
            'appointment_type' => 'vaccination',
            'appointment_date' => date('Y-m-d', strtotime('+7 days')),
            'appointment_time' => '11:00:00',
            'status' => 'pending',
            'notes' => 'Second dose appointment request',
        ]);

        $this->command->info('✅ Pending appointment created (hospital needs to approve)');

        // ============ COMPLETE ============
        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════');
        $this->command->info('🎉 DEMO DATA CREATED SUCCESSFULLY!');
        $this->command->info('═══════════════════════════════════════════');
        $this->command->info('');
        $this->command->info('📋 Testing Accounts:');
        $this->command->info('🔐 Admin:  admin@covid.com / password');
        $this->command->info('🏥 Hospital: hospital@demo.com / password');
        $this->command->info('👤 Patient: patient@demo.com / password');
        $this->command->info('');
        $this->command->info('💡 Test Workflow:');
        $this->command->info('1. Login as Hospital → Check dashboard');
        $this->command->info('2. Login as Patient → View appointments & results');
        $this->command->info('3. Login as Admin → Manage hospitals, vaccines, reports');
        $this->command->info('4. Hospital: Approve pending appointment → Update result');
        $this->command->info('5. Patient: Check updated results in profile');
        $this->command->info('');
    }
}
