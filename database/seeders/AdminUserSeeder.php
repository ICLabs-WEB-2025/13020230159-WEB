<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Cek jika admin belum ada (optional)
        if (!User::where('email', 'falah@example.com')->exists()) {
            $admin = User::create([
                'name' => 'falah',
                'email' => 'falah@example.com',
                'password' => bcrypt('12345678'), // Ganti dengan password kuat
            ]);
            
            // Assign role admin
            $admin->assignRole('admin'); // pastikan role 'admin' ada di tabel roles
        }
    }
}
