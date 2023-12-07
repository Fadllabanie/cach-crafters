<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
    
    public function getFillable()
    {
        return [
            'name_ar',
            'name_en',
            'icon',
        ];
    }

    public function getFillableType()
    {
        return [
            'name_ar' => 'string',
            'name_en' => 'string',
            'icon' => 'string',
        ];
    }
}
