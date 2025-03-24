<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'free',
            'price' => 0,
            'max_teams' => 1,
            'max_users_per_team' => 5,
        ];
    }

    public function free(): Factory
    {
        return $this->state([
            'name' => 'free',
            'price' => 0,
            'max_teams' => 1,
            'max_users_per_team' => 5,
        ]);
    }

    public function pro(): Factory
    {
        return $this->state([
            'name' => 'pro',
            'price' => 4999,
            'max_teams' => 5,
            'max_users_per_team' => 15,
        ]);
    }

    public function proPlus(): Factory
    {
        return $this->state([
            'name' => 'pro_plus',
            'price' => 9999,
            'max_teams' => 10,
            'max_users_per_team' => 30,
        ]);
    }

    public function admin(): Factory
    {
        return $this->state([
            'name' => 'admin_state',
            'price' => 9999,
            'max_teams' => 999,
            'max_users_per_team' => 999,
        ]);
    }
}
