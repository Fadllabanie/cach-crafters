<?php

namespace App\Models;

use App\Casts\Icon;
use App\Services\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    use Translatable;


    protected $fillable = [
        'name_ar',
        'name_en',
        'description_en',
        'description_ar',
        'icon',
    ];

    protected $translatedAttributes = [
        'name',
        'description'
    ];

    protected $casts = [
        'icon' => Icon::class,
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
