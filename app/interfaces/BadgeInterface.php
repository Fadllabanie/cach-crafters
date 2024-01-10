<?php

namespace App\Interfaces;

use App\Models\User;

interface BadgeInterface
{
    public function qualify(User $user): bool;
}
