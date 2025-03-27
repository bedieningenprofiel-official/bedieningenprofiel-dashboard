<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->withAdminStatus()->create([
            'name' => 'Super Admin',
            'username' => 'Bedieningenprofiel',
            'email' => 'bedieningenprofiel@hotmail.com',
            'password' => config('app.admin_password'),
            'is_admin' => true,
        ]);
    }
}
