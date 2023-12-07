<?php

namespace Database\Factories;

use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class SourceFactory extends Factory
{
    protected $model = Source::class;

    public function definition()
    {
        return [
        'name_ar' => $this->faker->word,
        'name_en' => $this->faker->word,
        'icon' => $this->faker->word,
    ];
}
}