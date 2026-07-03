<?php

namespace Database\Factories;

use App\Models\contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),

            'phone_number' => fake()->phoneNumber(),

            'user_id' => User::factory(),
        ];
    }
}
