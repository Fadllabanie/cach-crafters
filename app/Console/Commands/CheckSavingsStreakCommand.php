<?php

namespace App\Console\Commands;

use App\Services\Badges\SavingsStreakBadge;
use App\Models\User;
use App\Services\Badges\BadgeService;
use Illuminate\Console\Command;

class CheckSavingsStreakCommand extends Command
{
    protected $signature = 'badge:check-savings-streak';
    protected $description = 'Check and award Savings Streak Badge to eligible users';

    public function handle()
    {
        $badgeService = new BadgeService();
        $chunkSize = 1000; // Process 1000 users at a time

        User::chunk($chunkSize, function ($users) use ($badgeService) {
            foreach ($users as $user) {
                $badgeService->awardBadge($user, new SavingsStreakBadge());
            }
        });

        $this->info('Savings Streak Badge check completed.');
    }
}
