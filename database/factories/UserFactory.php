<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'rental_code' => $this->faker->randomNumber(),
            'image' => $this->faker->imageUrl(),
            'social_media' => $this->faker->userName,
            'industry' => $this->faker->word,
            'product_name' => $this->faker->word,
            'product_code' => $this->faker->unique()->randomNumber(),
            'type_account' => $this->faker->randomElement(['personal', 'business']),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'region' => $this->faker->randomElement(['vi', 'kr']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
