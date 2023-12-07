<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
        'name_ar' => $this->faker->word,
        'name_en' => $this->faker->word,
        'icon' => $this->faker->word,
    ];
}
}