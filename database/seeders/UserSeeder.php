<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin PPLG',
            'email' => 'admin@karya-pplg.local',
            'password' => Hash::make('admin123'),
            'role' => 1, // Admin
        ]);

        // Create Test Student User 1
        User::create([
            'name' => 'Siswa Test 1',
            'email' => 'siswa1@karya-pplg.local',
            'password' => Hash::make('siswa123'),
            'role' => 2, // Siswa
        ]);

        // Create Test Student User 2
        User::create([
            'name' => 'Siswa Test 2',
            'email' => 'siswa2@karya-pplg.local',
            'password' => Hash::make('siswa123'),
            'role' => 2, // Siswa
        ]);

        $this->command->info('✓ Admin dan 2 test students berhasil di-seed!');
        $this->command->info('');
        $this->command->info('Login Credentials:');
        $this->command->info('Admin:   admin@karya-pplg.local / admin123');
        $this->command->info('Siswa 1: siswa1@karya-pplg.local / siswa123');
        $this->command->info('Siswa 2: siswa2@karya-pplg.local / siswa123');
    }
}