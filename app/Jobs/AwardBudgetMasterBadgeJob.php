<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\Badges\BadgeService;
use App\Services\Badges\BudgetMasterBadge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AwardBudgetMasterBadgeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $badgeService = new BadgeService();
        $badgeService->awardBadge($this->user, new BudgetMasterBadge());
    }
}
