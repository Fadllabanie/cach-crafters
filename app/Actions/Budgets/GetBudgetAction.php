<?php

namespace App\Actions\Budgets;

use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class GetBudgetAction
{
    public function execute(int $id)
    {
        // $data['budget'] =  Budget::find($id);

        // if (!$data['budget']) {
        //     return null;
        // }

        // $data['transactions'] = Transaction::select('type', DB::raw('SUM(amount) as total'))
        //     ->where('source_id', $data['budget']->source_id)
        //     ->whereMonth('created_at', now()->month)
        //     ->whereYear('created_at', now()->year)
        //     ->groupBy('type')
        //     ->get();

        $data['budget'] = Budget::with('source')->findOrFail($id);

        // Get the start and end date for the current month
        $startDate = now()->startOfMonth()->toDateTimeString();
        $endDate = now()->endOfMonth()->toDateTimeString();

        // Fetch the totals for income and expense transactions for the current month
        $data['totals'] = Transaction::select('type', DB::raw('SUM(amount) as total'))
            // ->where('type', 'expense') // Ensure the source_id matches
            ->where('source_id', $data['budget']->source_id) // Ensure the source_id matches
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('type')
            ->get()
            ->keyBy('type'); // Key the results by type for easy access

        // Fetch all individual transactions for the current month
        $data['transactions'] = Transaction::where('source_id', $data['budget']->source_id) // Match the source_id
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        return $data;
    }
}
