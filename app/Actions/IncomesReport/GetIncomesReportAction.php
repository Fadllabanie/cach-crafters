<?php

namespace App\Actions\ExpensesReport;

use App\Models\Income;

class GetIncomesReportAction
{
    public function execute(string $date)
    {
        return Income::mine()
            ->when($date == 'last-day', function ($query) {
                $query->whereDate('date', now()->subDay());
            })
            ->when($date == 'last-week', function ($query) {
                $query->whereBetween('date', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
            })
            ->when($date == 'last-month', function ($query) {
                $query->whereMonth('date', '=', now()->subMonth()->month)
                    ->whereYear('date', '=', now()->subMonth()->year);
            })
            ->when($date == 'last-year', function ($query) {
                $query->whereYear('date', now()->subYear()->year);
            })->get();
    }
}
