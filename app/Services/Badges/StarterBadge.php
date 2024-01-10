<?php

namespace App\Services\Badges;

use App\Interfaces\BadgeInterface;
use App\Models\Badge;
use App\Models\User;

class StarterBadge implements BadgeInterface
{
    public function qualify(User $user): bool
    {
        $badge = Badge::firstOrCreate([
            'name' => 'Starter Badge',
            'description' => 'Awarded for signing up.'
        ]);

        $user->badges()->syncWithoutDetaching([$badge->id]);

        return true;
    }
}
