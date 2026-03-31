<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // STEP 1: Create roles and default admin user
        $this->call(RolesAndAdminSeeder::class);

        // STEP 2: Create demo data (hospitals, patients, vaccines)
        // $this->call(DemoDataSeeder::class);
    }
}
