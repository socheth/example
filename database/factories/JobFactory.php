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
            'description' => fake()->paragraph(10),
            'requirements' => fake()->paragraph(10),
            'benefits' => fake()->paragraph(10),
            'type' => fake()->randomElement(['Full Time', 'Part Time', 'Contract', 'Intern']),
            'category' => fake()->randomElement(['IT', 'Marketing', 'HR']),
            'location' => fake()->city(),
            'status' => fake()->randomElement(['open', 'closed']),
            'experience' => fake()->randomElement(['1 year', '2 years', '3 years', '4 years', '5 years', 'more']),
            'is_featured' => fake()->boolean(),
            'apply_url' => fake()->url(),
            'deadline' => fake()->date(),
            'is_active' => true,
            'salary' => fake()->randomNumber(4, true),
        ];
    }
}