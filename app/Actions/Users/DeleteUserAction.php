<?php

namespace App\Actions\Users;

use App\Models\User;

class DeleteUserAction
{
    public function execute(User $model): bool
    {

        return $model->delete();
    }
}
