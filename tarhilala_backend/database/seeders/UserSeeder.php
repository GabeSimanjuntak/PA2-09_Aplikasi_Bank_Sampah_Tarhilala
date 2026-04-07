<?php

namespace DatabaseSeeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Admin pertama
        User::create([
            'id' => 1,
            'nama' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'nomor_telepon' => '08123456789',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
