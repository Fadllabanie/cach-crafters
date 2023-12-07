<?php

    namespace App\Actions\Users;

use App\Models\User;

class GetAllUserAction
{
    public function execute()
    {
        return User::all();
    }
}
