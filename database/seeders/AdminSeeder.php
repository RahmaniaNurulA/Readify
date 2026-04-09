<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dulu agar tidak duplikat
        if (!User::where('email', 'admin@readify.com')->exists()) {
            User::create([
                'email'          => 'admin@readify.com',
                'password'       => Hash::make('Admin@123'),  // ganti password ini!
                'role'           => 'admin',
                'tanggal_daftar' => now()->toDateString(),
                'last_login'     => null,
            ]);
        }
    }
}