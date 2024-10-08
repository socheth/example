<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => fake()->address(),
            'description' => fake()->text(),
            'logo' => fake()->imageUrl(200, 200),
            'website' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'user_id' => User::all()->random()->id,
        ];
    }
}