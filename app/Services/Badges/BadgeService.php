<?php

namespace App\Services\Badges;


use App\Interfaces\BadgeInterface;
use App\Models\User;
use App\Models\Badge;

class BadgeService
{
    public static function awardBadge(User $user, BadgeInterface $badgeType)
    {
        if ($badgeType->qualify($user)) {
            $badge = Badge::firstOrCreate([
                'name_ar' => class_basename($badgeType),
                'name_en' => class_basename($badgeType),
                'description_en' => '',
                'description_ar' => '',
                'icon' => '',
            ]);

            $user->badges()->syncWithoutDetaching([$badge->id]);
        }
    }
}
