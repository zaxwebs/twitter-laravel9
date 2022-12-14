<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		$DPs = collect(File::files(public_path('seeder/DPs')));
		$covers = collect(File::files(public_path('seeder/photos')));
		
        return [
            'name' => fake()->firstName() . ' ' . fake()->lastName(),
			'username' => fake()->userName,
            'email' => fake()->unique()->safeEmail(),
			'bio' => fake()->paragraph(1),
			'badge' => rand(0,1),
			'display_picture' => 'seeder/DPs/' . $DPs->random()->getFilename(),
			'cover_image' => 'seeder/photos/' . $covers->random()->getFilename(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
