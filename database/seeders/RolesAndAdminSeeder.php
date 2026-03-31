<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * RolesAndAdminSeeder
 *
 * This seeder creates the three essential roles for the COVID Booking System:
 * 1. Admin - Can manage all hospitals, patients, vaccines, bookings, and reports
 * 2. Hospital - Can manage their own patients, appointments, and update results
 * 3. Patient - Can search hospitals, book appointments, and view their results
 *
 * It also creates a default admin user that can log in immediately.
 *
 * Usage: php artisan db:seed --class=RolesAndAdminSeeder
 */
class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /**
         * STEP 1: Create the three roles using Spatie Permission.
         * These roles will be assigned to users.
         */
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'hospital']);
        Role::create(['name' => 'patient']);

        /**
         * STEP 2: Create a default admin user.
         * This admin can log in immediately after setup.
         * Default credentials:
         * Email: admin@covid.com
         * Password: password
         */
        $admin = User::create([
            'name'     => 'System Administrator',
            'email'    => 'admin@covid.com',
            'password' => Hash::make('password'),
            // Additional fields for user_type and status can be added later
            // with migrations
        ]);

        /**
         * Assign 'admin' role to this user.
         * This gives the user full access to admin routes.
         */
        $admin->assignRole('admin');

        /**
         * Optional: Create example hospital user (commented out for now)
         * Uncomment and modify if you want demo hospital account
         */
        // $hospitalUser = User::create([
        //     'name' => 'City General Hospital',
        //     'email' => 'hospital@demo.com',
        //     'password' => Hash::make('password'),
        // ]);
        // $hospitalUser->assignRole('hospital');

        /**
         * Optional: Create example patient user (commented out)
         * Uncomment if you want demo patient account
         */
        // $patientUser = User::create([
        //     'name' => 'John Doe',
        //     'email' => 'patient@demo.com',
        //     'password' => Hash::make('password'),
        // ]);
        // $patientUser->assignRole('patient');

        /**
         * Log success message to console when running seeder.
         */
        $this->command->info('✅ Roles created successfully!');
        $this->command->info('✅ Default admin user created:');
        $this->command->info('   Email: admin@covid.com');
        $this->command->info('   Password: password');
    }
}
