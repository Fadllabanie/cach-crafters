<?php

namespace App\Actions\Users;

use App\Models\User;

class CreateUserAction
{
    public function execute(array $data): User
    {
        // Validate and create a new User
        // TODO: Add your validation and creation logic here

        return User::create($data);
    }
}
