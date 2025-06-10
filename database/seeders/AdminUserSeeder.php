<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin di tabel 'admins'
        if (!Admin::where('email', 'admin@example.com')->exists()) { // Gunakan Model Admin
            Admin::create([ // Gunakan Model Admin
                'name' => 'Rizki',
                'email' => 'project@gmail.com',
                'password' => Hash::make('123456789'), // Ganti 'passwordadmin' dengan password yang kuat
            ]);
            $this->command->info('Akun Admin berhasil dibuat di tabel admins!');
        } else {
            $this->command->info('Akun Admin sudah ada di tabel admins.');
        }
    }
}