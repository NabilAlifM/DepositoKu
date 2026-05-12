<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        $adminExists = User::where('email', 'admin@deposito.com')->exists();
        
        if ($adminExists) {
            $this->command->info('Admin user already exists!');
            return;
        }

        // Buat user admin baru
        User::create([
            'name' => 'Admin',
            'email' => 'admin@deposito.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@deposito.com');
        $this->command->info('Password: admin123');
    }
}