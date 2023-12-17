<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class Transaction extends Model
{
    use HasFactory;

    public function getFillable()
    {
        return [
            'user_id',
            'source_id',
            'type',
            'amount',
            'transaction_date',
        ];
    }

    public function getFillableType()
    {
        return [
            'user_id' => 'belongsTo',
            'source_id' => 'belongsTo',
            'type' => 'float',
            'amount' => 'float',
            'transaction_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeOfMonth($query, $month)
    {
        if ($month) {
            $query->whereYear('transaction_date', '=', date('Y', strtotime($month)))
                ->whereMonth('transaction_date', '=', date('m', strtotime($month)));
        }
        return $query;
    }

    // public static function getStatistics($userId, $timeFrame = 'month', $type = 'expense')
    // {
    //     // Filter by time frame (day, week, month, year)
    //     $startDate = now()->startOf($timeFrame);
    //     $endDate = now()->endOf($timeFrame);

    //     // Query for total expenses/income over time
    //     $stats = self::select(
    //         DB::raw('SUM(amount) as total'),
    //         DB::raw('DATE(transaction_date) as date')
    //     )
    //         ->where('user_id', $userId)
    //         ->where('type', $type)
    //         ->whereBetween('transaction_date', [$startDate, $endDate])
    //         ->groupBy('date')
    //         ->orderBy('date')
    //         ->get();

    //     // Query for top spending items
    //     $topSpending = self::select('source_id', 'amount', 'transaction_date')
    //         ->where('user_id', $userId)
    //         ->where('type', 'expense') // Assuming you only want expenses for top spending
    //         ->whereBetween('transaction_date', [$startDate, $endDate])
    //         ->orderBy('amount', 'desc')
    //         ->limit(5) // Assuming you want the top 5
    //         ->get();

    //     return [
    //         'stats' => $stats,
    //         'topSpending' => $topSpending
    //     ];
    // }


    public static function getStatistics($userId, $type = 'expense', $timeFrame = 'month', $specificMonth = null)
    {
        $validTimeFrames = ['day', 'week', 'month', 'year'];
        if (!in_array($timeFrame, $validTimeFrames)) {
            throw new InvalidArgumentException("Invalid time frame: " . $timeFrame);
        }
        // Determine the start and end date based on the timeframe and specific month if provided
        if ($specificMonth) {
            $startDate = Carbon::parse($specificMonth)->startOfMonth();
            $endDate = Carbon::parse($specificMonth)->endOfMonth();
        } else {
            switch ($timeFrame) {
                case 'day':
                    $startDate = now()->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
                case 'week':
                    $startDate = now()->startOfWeek();
                    $endDate = now()->endOfWeek();
                    break;
                case 'month':
                    $startDate = now()->startOfMonth();
                    $endDate = now()->endOfMonth();
                    break;
                case 'year':
                    $startDate = now()->startOfYear();
                    $endDate = now()->endOfYear();
                    break;
                default:
                    throw new InvalidArgumentException("Invalid time frame");
            }
        }

        // Adjust the date format based on the selected timeframe
        $dateFormat = match ($timeFrame) {
            'day' => '%H:00:00', // hourly for day
            'week' => '%Y-%m-%d', // daily for week
            'month' => '%Y-%m-%d', // daily for month
            'year' => '%Y-%m' // monthly for year
        };

        // Query for statistics
        $stats = self::select(
            DB::raw("SUM(amount) as total"),
            DB::raw("DATE_FORMAT(transaction_date, '{$dateFormat}') as formatted_date")
        )
            ->where('user_id', $userId)
            ->where('type', $type)
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->groupBy('formatted_date')
            ->orderBy('formatted_date')
            ->get();

        // Format the statistics for the response
        $formattedStats = $stats->map(function ($stat) use ($timeFrame) {
            // Adjust the date format for response based on the selected timeframe
            $date = match ($timeFrame) {
                'day' => Carbon::createFromFormat('H:00:00', $stat->formatted_date)->format('H:i:s'),
                'week', 'month' => Carbon::createFromFormat('Y-m-d', $stat->formatted_date)->format('Y-m-d'),
                'year' => Carbon::createFromFormat('Y-m', $stat->formatted_date)->format('Y-m'),
                default => $stat->formatted_date,
            };
            return [
                'date' => $date,
                'total' => $stat->total,
            ];
        });
        $topSpending = self::select('source_id', 'amount', 'transaction_date')
            ->where('user_id', $userId)
            ->where('type', 'expense') // Assuming you only want expenses for top spending
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->orderBy('amount', 'desc')
            ->limit(5) // Assuming you want the top 5
            ->get();

        return [
            'stats' => $stats,
            'topSpending' => $topSpending
        ];
    }

    public static function getSummary($userId)
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        $transactions = Transaction::where('user_id', $userId)
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->get();

        $income = $transactions->where('type', 'income')->sum('amount');
        $expenses = $transactions->where('type', 'expense')->sum('amount');
        $balance = $income - $expenses;

        return [
            'balance' => formatCurrencyNumber($balance),
            'income' => formatCurrencyNumber($income),
            'expenses' => formatCurrencyNumber($expenses)
        ];
    }
}
