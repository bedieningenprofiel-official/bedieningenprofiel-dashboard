<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'current_team_id' => null,
            /* 'church_id' => null, */
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user should have a random plan/subscription attached.
     */
    public function withRandomPlan(): static
    {
        return $this->afterCreating(function (User $user) {
            $randomPlan = Plan::inRandomOrder()->first();

            $user->subscriptions()->create([
                'plan_id' => $randomPlan->id,
                'starts_at' => now(),
                'ends_at' => match ($randomPlan->name) {
                    'free' => now()->addYears(10),
                    default => now()->addDays(30)
                },
                'status' => 'active',
            ]);
        });
    }

    /**
     * Indicate that the user should have a free plan/subscription attached.
     */
    public function withFreePlan(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->subscriptions()->create([
                'plan_id' => Plan::where('name', 'free')->first()->id,
                'starts_at' => now(),
                'ends_at' => now()->addYears(10),
                'status' => 'active',
            ]);
        });
    }

    /**
     * Indicate that the user should have a pro plan/subscription attached.
     */
    public function withProPlan(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->subscriptions()->create([
                'plan_id' => Plan::where('name', 'pro')->first()->id,
                'starts_at' => now(),
                'ends_at' => now()->addDays(30),
                'status' => 'active',
            ]);
        });
    }

    /**
     * Indicate that the user should have a pro plus plan/subscription attached.
     */
    public function withProPlusPlan(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->subscriptions()->create([
                'plan_id' => Plan::where('name', 'pro_plus')->first()->id,
                'starts_at' => now(),
                'ends_at' => now()->addDays(30),
                'status' => 'active',
            ]);
        });
    }
}
