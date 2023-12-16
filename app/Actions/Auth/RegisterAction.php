<?php

namespace App\Actions\Auth;

use App\Models\User;

class RegisterAction
{
    public function execute(array $data): User
    {
        $user = User::create([
            'name' => explode('@', $data['email'])[0],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' =>  bcrypt($data['password']),
            'avatar' => 'avatar.png',
            'currency' => '$',
        ]);

        $token = $user->createToken('default-register');

        $user->update([
            'remember_token' => $token->plainTextToken
        ]);
        
        return  $user;
    }
}
