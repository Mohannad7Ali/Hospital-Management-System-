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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // \App\Models\User::create([
        //     'name' => 'Mohannad Ali',
        //     'email' => 'Mohannad7257@gmail.com',
        //     'password' => Hash::make('123456'),
        // ]);
        // \App\Models\Admin::create([
        //     'name' => 'Mohannad Ali',
        //     'email' => 'Mohannad7257@gmail.com',
        //     'password' => Hash::make('123456'),
        // ]);

        $this->call([
            UserSeeder::class ,
            AdminSeeder::class,
            AppointmentSeeder::class,
            SectionSeeder::class,
            DoctorSeeder::class,
            ImageSeeder::class,
        ]);
    }
}
