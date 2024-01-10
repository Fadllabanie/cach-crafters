<?php

namespace App\Services\Badges;

use App\Interfaces\BadgeInterface;
use App\Models\User;
use Carbon\Carbon;

class SavingsStreakBadge implements BadgeInterface
{
    public function qualify(User $user): bool
    {
        $requiredStreakMonths = 6;
        $requiredGrowthRate = 0.05; // 5%

        $currentMonth = Carbon::now();
        $previousMonthSavings = null;
        $streakCount = 0;

        for ($i = 0; $i < $requiredStreakMonths; $i++) {
            $monthSavings = $this->calculateMonthlySavings($user, $currentMonth->copy()->subMonths($i));
          
            if ($i > 0 && $previousMonthSavings !== null && $previousMonthSavings != 0) {
                $growth = ($monthSavings - $previousMonthSavings) / $previousMonthSavings;
                if ($growth >= $requiredGrowthRate) {
                    $streakCount++;
                } else {
                    break;
                }
            }

            $previousMonthSavings = $monthSavings;
        }

        return $streakCount === $requiredStreakMonths - 1;
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
