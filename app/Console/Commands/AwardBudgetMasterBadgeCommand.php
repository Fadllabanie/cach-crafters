<?php

namespace App\Console\Commands;

use App\Jobs\AwardBudgetMasterBadgeJob;
use App\Models\User;
use App\Services\Badges\BadgeService;
use App\Services\Badges\BudgetMasterBadge;
use Illuminate\Console\Command;

class AwardBudgetMasterBadgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badge:budget-master-badge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Award Budget Master Badge to eligible users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $badgeService = new BadgeService();
        $chunkSize = 1000; // Process 1000 users at a time
    
        User::chunk($chunkSize, function ($users) use ($badgeService) {
            foreach ($users as $user) {
                $badgeService->awardBadge($user, new BudgetMasterBadge());
            }
        });
    
        $this->info('Checked and awarded Budget Master Badges to eligible users.');


        /////###############
        // queue
        /////###############
        // $chunkSize = 1000;

        // User::chunk($chunkSize, function ($users) {
        //     foreach ($users as $user) {
        //         AwardBudgetMasterBadgeJob::dispatch($user);
        //     }
        // });
    
        // $this->info('Dispatched jobs to award Budget Master Badges.');
    }
}
