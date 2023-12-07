<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'source_id' => \App\Models\Source::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }
}
