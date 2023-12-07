<?php

namespace App\Actions\Incomes;

use App\Models\Income;

class UpdateIncomeAction
{
    public function execute(Income $model, array $data): Income
    {

        $model->update($data);

        return $model;
    }
}
