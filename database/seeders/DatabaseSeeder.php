<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $project = Project::create([
            'name' => 'Tes Project',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'ethan.sarifuddin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'pin' => '1234',
        ]);

        User::create([
            'name' => 'Rezky',
            'email' => 'rezky14.ramadhan@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'Officer',
            'pin' => '1234',
        ]);

        User::create([
            'name' => 'Felix',
            'email' => 'felix.share@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'PM',
            'pin' => '1234',
        ]);

        User::create([
            'name' => 'Im',
            'email' => 'im@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'VP QHSE',
            'pin' => '1234',
        ]);
    }
}
