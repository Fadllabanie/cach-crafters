<?php

namespace App\Services\Badges;

use App\Interfaces\BadgeInterface;
use App\Models\Budget;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class BudgetMasterBadge implements BadgeInterface
{
    public function qualify(User $user): bool
    {
        // Example logic to check if the user has stuck to the budget for three consecutive months
        // This assumes you have a method to determine if the user has stuck to the budget in a given month

        $currentMonth = Carbon::now();
        for ($i = 0; $i < 3; $i++) {
            if (!$this->stuckToBudget($user, $currentMonth->copy()->subMonths($i))) {
                return false;
            }
        }

        return true;
    }

    private function stuckToBudget(User $user, Carbon $month): bool
    {

        // Implement the logic to check if the user has stuck to their budget for the specified month
        // Return true if the user stuck to the budget, false otherwise
        // This is an example, replace with your actual logic

        $monthlyBudget = Budget::where('user_id', $user->id)
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->sum('amount');

        /// ## if null you shou

        // Get the total spending for the month
        $monthlySpending = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->sum('amount');
            
        dd($monthlySpending);
        // Check if the spending did not exceed the budget
        return $monthlySpending <= $monthlyBudget;


        return true; // Placeholder
    }
}
