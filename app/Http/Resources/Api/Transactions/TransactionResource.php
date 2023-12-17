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
            'amount' => $this->amount,
            'transaction_date' => $this->transaction_date,
            'created_at' => $this->created_at,
        ];
    }
}
