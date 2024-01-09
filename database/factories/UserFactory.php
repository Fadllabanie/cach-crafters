<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'password' => Hash::make('12345678'),
            'email_verified_at' =>  \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'avatar' => $this->faker->word,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone' => $this->faker->word,
            'currency' => '$',
            // 'remember_token' => \Illuminate\Support\Str::random(60),
        ];
    }
}
