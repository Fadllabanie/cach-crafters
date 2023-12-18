<?php

namespace Database\Factories;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'user_id' => 23,
            // 'user_id' => \App\Models\User::factory(),
            'source_id' => $this->faker->randomElement([1,2,3,4,2018,2019,2020]),
            'type' => $this->faker->randomElement(['income', 'expense']),
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'transactionDate' => Carbon::now()->subDays(rand(0, 365)),
        ];
    }
}
