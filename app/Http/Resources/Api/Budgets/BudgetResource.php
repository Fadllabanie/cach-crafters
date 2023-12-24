<?php

namespace App\Http\Resources\Api\Budgets;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BudgetResource extends JsonResource
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
            'name' => $this->name,
            'source' => [
                'id' => $this->source->id,
                'name' => $this->source->name,
                'icon' => $this->source->icon,
            ],
            'period' => $this->period,
            'amount' => formatCurrencyNumber($this->amount),
            'is_budget_overspend' => (bool) $this->is_budget_overspend,
            'is_exceeded' => (bool) $this->is_exceeded,
            'created_at' => date_format($this->created_at, 'Y-m-d h:i:s'),
        ];
    }
}
