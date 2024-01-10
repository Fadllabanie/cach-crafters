<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\Badges\BadgeService;
use App\Services\Badges\SmartSpenderBadge;

class SmartSpenderBadgeCommand extends Command
{
    protected $signature = 'badge:smart-spender';
    protected $description = 'Award Smart Spender Badge to eligible users';

    public function handle(BadgeService $badgeService)
    {
        $this->info('Checking and awarding Smart Spender Badges...');

        $badgeType = new SmartSpenderBadge();
        $chunkSize = 100; // Process 100 users at a time

        User::chunk($chunkSize, function ($users) use ($badgeService, $badgeType) {
            foreach ($users as $user) {
                if ($badgeType->qualify($user)) {
                    $badgeService->awardBadge($user, $badgeType);
                }
            }
        });

        $this->info('Smart Spender Badge check completed.');
    }
}
