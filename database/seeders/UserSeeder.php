<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(5)->withRandomPlan()->create();
        User::factory(5)->withProPlan()->create();
        User::factory(3)->withProPlusPlan()->create();
    }
}
