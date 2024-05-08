<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'rianwahyu26@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
            'phone' => '123456789',
        ]);

        //seeder profile Clinicn
        \App\Models\ProfileClinic::factory()->create([
            'name' => 'RG KLinik',
            'address' => 'Jl. Raya Ciputat Parung No 1 ',
            'phone' => '12345678',
            'email' => 'rgklinik@gmail.com',
            'doctor_name' => 'Dr Rian',
            'unique_code' => '12345678',
        ]);

        $this->call(
            [
                DoctorSeeder::class,
                DoctorScheduleSeeder::class
            ]
        );
    }
}
