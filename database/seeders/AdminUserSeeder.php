<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Assuming your User model is in App\Models

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fullname' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => 'admin', // Storing password as plain text (SECURITY RISK)
            'picture' => 'default_admin.png', // Add a placeholder or ensure it's nullable
            'type' => 'Admin' // Use 'type' column and set to 'Admin'
        ]);
    }
}
