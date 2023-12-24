<?php

namespace Database\Factories;

use App\Models\Budget;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class BudgetFactory extends Factory
{
    protected $model = Budget::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'user_id' => \App\Models\User::factory(),
            'source_id' => \App\Models\Source::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'period' => 'yearly',
            'is_budget_overspend' => false,
            'is_exceeded' => false,
        ];
    }
}
