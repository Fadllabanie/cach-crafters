<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }
}
