<?php

namespace App\Actions\Badges;

use App\Models\Budget;

class GetAllBadgeAction
{
    public function execute()
    {
        return auth()->user()->badges;

    }
}
