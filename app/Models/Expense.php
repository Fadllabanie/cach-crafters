<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'date',
    ];

    public function getFillable()
    {
        return [
            'user_id',
            'category_id',
            'amount',
            'date',
        ];
    }

    public function getFillableType()
    {
        return [
            'user_id' => 'belongsTo',
            'category_id' => 'belongsTo',
            'amount' => 'float',
            'date' => 'datetime',
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
