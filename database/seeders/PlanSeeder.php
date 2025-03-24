<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::factory()->free()->create();
        Plan::factory()->pro()->create();
        Plan::factory()->proPlus()->create();
        Plan::factory()->admin()->create();
    }
}
