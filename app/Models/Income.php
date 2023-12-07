<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_id',
        'amount',
        'date',
    ];

    public function getFillable()
    {
        return [
            'user_id',
            'source_id',
            'amount',
            'date',
        ];
    }

    public function getFillableType()
    {
        return [
            'user_id' => 'belongsTo',
            'source_id' => 'belongsTo',
            'amount' => 'float',
            'date' => 'datetime',
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
