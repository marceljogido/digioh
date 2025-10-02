<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EnsureAdminUserSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah user super@admin.com sudah ada
        $user = User::where('email', 'super@admin.com')->first();
        
        if ($user) {
            // Update user jika sudah ada
            $user->update([
                'password' => Hash::make('secret'),
                'status' => 1, // Aktifkan user
                'email_verified_at' => now(), // Verifikasi email
            ]);
            
            // Pastikan user memiliki role super admin
            $user->assignRole('super admin');
            
            echo "User super@admin.com diperbarui dengan password 'secret', status aktif, dan role super admin.\n";
        } else {
            // Buat user baru jika belum ada
            $user = User::create([
                'name' => 'Super Admin',
                'email' => 'super@admin.com',
                'password' => Hash::make('secret'),
                'status' => 1,
                'email_verified_at' => now(),
            ]);
            
            // Beri role super admin
            $user->assignRole('super admin');
            
            echo "User super@admin.com dibuat dengan password 'secret', status aktif, dan role super admin.\n";
        }
    }
}