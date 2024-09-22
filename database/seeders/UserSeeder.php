<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create candidate
        User::create([
            'name' => 'Candidate User',
            'email' => 'candidate@example.com',
            'password' => Hash::make('candidate@123'),
            'role' => 'candidate',
        ]);

        // Create company
        User::create([
            'name' => 'Company User',
            'email' => 'company@example.com',
            'password' => Hash::make('company@123'),
            'role' => 'company',
        ]);
    }
}
