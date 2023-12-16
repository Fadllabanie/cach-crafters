<?php

namespace App\Actions\Transactions;

use App\Models\Transaction;

class DeleteTransactionAction
{
    public function execute(Transaction $model): bool
    {

        return $model->delete();
    }
}
