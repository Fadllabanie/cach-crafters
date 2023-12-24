<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'source_id',
        'amount',
        'period',
        'is_budget_overspend',
        'is_exceeded',
    ];

    public function getFillable()
    {
        return [
            'name',
            'user_id',
            'source_id',
            'amount',
            'period',
            'is_budget_overspend',
            'is_exceeded',
        ];
    }

    public function getFillableType()
    {
        return [
            'name' => 'string',
            'user_id' => 'belongsTo',
            'source_id' => 'belongsTo',
            'amount' => 'float',
            'period' => 'string',
            'is_budget_overspend' => 'boolean',
            'is_exceeded' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
