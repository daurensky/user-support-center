<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserApplication>
 */
class UserApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status'  => UserApplication::STATUS_ACTIVE,
            'message' => fake()->realText(maxNbChars: 1000),
            'comment' => fake()->realText(maxNbChars: 1000),
        ];
    }
}
