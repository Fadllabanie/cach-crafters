<?php

namespace App\Actions\Users;

use App\Models\User;

class UpdateUserAction
{
    public function execute(User $model, array $data): User
    {

        $model->update($data);

        return $model;
    }
}
