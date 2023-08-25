<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRequest>
 */
class UserRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'status'  => UserRequest::STATUS_ACTIVE,
            'message' => fake()->realText(maxNbChars: 1000),
        ];
    }
}
