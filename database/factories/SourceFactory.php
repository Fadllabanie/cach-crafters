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
        $categoriesAr = ['منزل', 'ترفيه', 'طعام', 'سيارة'];
        $categoriesEn = ['Home', 'Entertainment', 'Food', 'Car'];
        $icons = ['house', 'game-controller', 'hamburger', 'car-side'];

        return [
            'name_ar' => $this->faker->randomElement($categoriesAr),
            'name_en' => $this->faker->randomElement($categoriesEn),
            'icon' => $this->faker->randomElement($icons),
        ];
    }
}
