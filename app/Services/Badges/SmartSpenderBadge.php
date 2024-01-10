<?php

namespace App\Services\Badges;

use App\Interfaces\BadgeInterface;
use App\Models\User;
use Carbon\Carbon;

class SmartSpenderBadge implements BadgeInterface
{
    public function qualify(User $user): bool
    {
        $requiredReductionRate = 0.10; // 10%
        $currentMonth = Carbon::now();
        $previousMonth = $currentMonth->copy()->subMonth();
        $twoMonthsAgo = $currentMonth->copy()->subMonths(2);

        $previousMonthSpending = $this->calculateMonthlySavings($user, $previousMonth);
        $twoMonthsAgoSpending = $this->calculateMonthlySavings($user, $twoMonthsAgo);

        // Avoid division by zero
        if ($twoMonthsAgoSpending == 0) {
            return false;
        }

        $reduction = ($twoMonthsAgoSpending - $previousMonthSpending) / $twoMonthsAgoSpending;

        return $reduction >= $requiredReductionRate;
    }

    private function calculateMonthlySavings(User $user, Carbon $month): float
    {
    
        $totals = $user->transactions()
            ->selectRaw('type, SUM(amount) as total')
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->groupBy('type')
            ->get()
            ->pluck('total', 'type');

        $income = $totals->get('income', 0);
        $expenses = $totals->get('expense', 0);
       
        return $income - $expenses;
    }
}
