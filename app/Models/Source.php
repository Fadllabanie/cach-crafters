<?php

namespace App\Models;

use App\Casts\Icon;
use App\Services\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory, Translatable;


    public function getFillable()
    {
        return [
            'name_ar',
            'name_en',
            'icon',
            'color',
        ];
    }

    public function getFillableType()
    {
        return [
            'name_ar' => 'string',
            'name_en' => 'string',
            'icon' => 'string',
            'color' => 'string',
        ];
    }

    protected $translatedAttributes = [
        'name'
    ];

    protected $casts = [
        'icon' => Icon::class,
    ];
}
