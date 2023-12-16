<?php

namespace App\Actions\Transactions;

use App\Models\Transaction;

class CreateTransactionAction
{
    public function execute(array $data): Transaction
    {
        // Validate and create a new Transaction
        // TODO: Add your validation and creation logic here
        $data['user_id'] = auth()->id();
        return Transaction::create($data);
    }
}
