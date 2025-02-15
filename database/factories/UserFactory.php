<?php

namespace Database\Factories;

use App\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
            'user_type'         => UserTypeEnum::CLIENT, // Default to client
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Define an admin user.
     */
    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'user_type' => UserTypeEnum::ADMIN,
            'email'     => 'admin@example.com', // Ensuring admin email is predictable
        ]);
    }

    /**
     * Define a staff user.
     */
    public function staff(): static
    {
        return $this->state(fn(array $attributes) => [
            'user_type' => UserTypeEnum::STAFF,
        ]);
    }

    /**
     * Define a client user.
     */
    public function client(): static
    {
        return $this->state(fn(array $attributes) => [
            'user_type' => UserTypeEnum::CLIENT,
        ]);
    }
}
