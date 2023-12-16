<?php

namespace App\Actions\Transactions;

use App\Models\Transaction;

class GetAllTransactionAction
{
    public function execute()
    {
        return Transaction::with('source')->mine()->orderByDESC('id')->paginate();
    }
}
