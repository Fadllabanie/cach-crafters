<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function getFillable()
    {
        return [
            'name',
            'email',
            'password',
            'email_verified_at',
            'avatar',
            'gender',
            'phone',
            'currency',
            'remember_token',
        ];
    }

    public function getFillableType()
    {
        return [
            'name' => 'string',
            'email' => 'email',
            'password' => 'password',
            'email_verified_at' => 'date',
            'avatar' => 'string',
            'gender' => 'string',
            'phone' => 'string',
            'currency' => 'string',
            'remember_token' => 'token',
        ];
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'currency',
    ];


    public function authProviders()
    {
        return $this->hasMany(AuthProvider::class, 'user_id', 'id');
    }
}
