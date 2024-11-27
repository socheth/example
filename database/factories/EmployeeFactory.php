<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
            'user_id' => User::all()->random()->id,
            'company_id' => Company::all()->random()->id,
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'address' => fake()->address(),
            'avatar' => fake()->imageUrl(200, 200),
        ];
    }
}