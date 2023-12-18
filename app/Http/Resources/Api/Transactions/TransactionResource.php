<?php

namespace App\Http\Resources\Api\Transactions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'source' => [
                'id' => $this->source->id,
                'name' => $this->source->name,
                'icon' => $this->source->icon,
            ],
            'type' => $this->type,
            'amount' => formatCurrencyNumber($this->amount),
            'transactionDate' => $this->transactionDate,
            'created_at' => date_format($this->created_at, 'Y-m-d h:i:s'),
        ];
    }
}
