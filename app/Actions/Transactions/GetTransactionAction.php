<?php

    namespace App\Actions\Transactions;

use App\Models\Transaction;

class GetTransactionAction
{
    public function execute(int $id): ?Transaction
    {
        return Transaction::mine()->find($id);
    }
}
