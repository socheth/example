<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->jobTitle();
        return [
            'user_id' => User::all()->random()->id,
            'company_id' => Company::all()->random()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => fake()->paragraph(10),
            'salary' => fake()->randomNumber(4, true),
        ];
    }
}