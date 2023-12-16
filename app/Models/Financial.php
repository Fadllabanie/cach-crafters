<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;

    public function getFillable()
    {
        return [
            'user_id',
            'total_balance',
            'income',
            'expenses',
        ];
    }

    public function getFillableType()
    {
        return [
            'user_id' => 'belongsTo',
            'total_balance' => 'float',
            'income' => 'float',
            'expenses' => 'float',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
