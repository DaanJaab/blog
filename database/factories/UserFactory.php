<?php

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $name = substr($this->faker->unique()->name(), 0, 30);
        return [
            'name' => $name,
            'name_slug' => Str::slug($name),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->randomElement([null, $this->faker->dateTimeBetween('-60 days')]),
            'password' => Hash::make('12341234'),
            'remember_token' => null,
            'role' => $this->faker->randomElement(UserRole::TYPES),
            'footer' => $this->faker->randomElement([null, $this->faker->realText(400)]),
            'banned_at' => $this->faker->randomElement([null, null, $this->faker->dateTimeBetween('-60 days')]),
            'deleted_at' => $this->faker->randomElement([null, null, null, $this->faker->dateTimeBetween('-60 days')])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
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
