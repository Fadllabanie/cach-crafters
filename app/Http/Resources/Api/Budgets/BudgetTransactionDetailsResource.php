<?php

namespace App\Http\Resources\Api\Budgets;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BudgetTransactionDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'amount' => formatCurrencyNumber($this->amount),
            'transactionDate' => $this->transactionDate,
        ];
    }
}
