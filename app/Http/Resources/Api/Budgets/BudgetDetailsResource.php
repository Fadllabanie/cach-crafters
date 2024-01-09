<?php

namespace App\Http\Resources\Api\Budgets;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BudgetDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $incomeTotal = $this->getTotalAmount('income');
        $expenseTotal = $this->getTotalAmount('expense');

        return [
            'id' => $this['budget']->id,
            'name' => $this['budget']->name,
            'source' => [
                'id' => $this['budget']->source->id,
                'name' => $this['budget']->source->name,
                'icon' => $this['budget']->source->icon,
            ],
            'period' => $this['budget']->period,
            'amount' => formatCurrencyNumber($this['budget']->amount),
            'is_overloaded' => (bool) $this->isOverloaded($this['budget']->amount, $incomeTotal, $expenseTotal),
            'created_at' => $this['budget']->created_at->format('Y-m-d h:i:s'),
            'expense' => [
                'type' => 'expense',
                'total' => formatCurrencyNumber($expenseTotal),
            ],
            'income' => [
                'type' => 'income',
                'total' => formatCurrencyNumber($incomeTotal),
            ],
            'balance' => $this->calculateBalance($incomeTotal, $expenseTotal),
            'transactions' => BudgetTransactionDetailsResource::collection($this['transactions']),
        ];
    }

    private function calculateBalance(float $totalIncomes, float $totalExpenses): string
    {
        return formatCurrencyNumber($totalIncomes - $totalExpenses);
    }

    private function isOverloaded(float $totalBudget, float $totalIncomes, float $totalExpenses): bool
    {
        return $totalBudget < ($totalIncomes - $totalExpenses);
    }

    private function getTotalAmount(string $type): float
    {
        return isset($this['totals'][$type]) ? $this['totals'][$type]->total : 0.00;
    }
}
