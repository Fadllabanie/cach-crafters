<?php

namespace App\Actions\Transactions;

use App\Models\Transaction;

class UpdateTransactionAction
{
    public function execute(Transaction $model, array $data): Transaction
    {

        $model->mine()->update($data);

        return $model;
    }
}
