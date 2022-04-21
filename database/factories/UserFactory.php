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
        $create_date = $this->faker->dateTimeBetween('-60 days', '-20 days');
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->randomElement([null, $this->faker->dateTimeBetween('-19 days', '-5 days')]),
            'password' => Hash::make('12341234'),
            'role' => $this->faker->randomElement([UserRole::USER, UserRole::USER, UserRole::USER, UserRole::USER, UserRole::ADMIN]),
            'signature' => $this->faker->randomElement([null, $this->faker->realText(400)]),
            'created_at' => $create_date,
            'updated_at' => $this->faker->randomElement([$create_date, $create_date, $this->faker->dateTimeBetween('-19 days', '-5 days')]),
            'deleted_at' => $this->faker->randomElement([null, null, null, $this->faker->dateTimeBetween('-4 days')])
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
