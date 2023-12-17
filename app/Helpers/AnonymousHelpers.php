<?php

use Illuminate\Support\Facades\File;

if (!function_exists('formatCurrencyNumber')) {

    function formatCurrencyNumber($number, $decimals = 2, $decimal_separator = '.', $thousands_separator = ',')
    {
        return '$' . number_format($number, $decimals, $decimal_separator, $thousands_separator);
    }
}

if (!function_exists('randomAvatar')) {

    function randomAvatar()
    {
        $avatarsPath = 'avatars';
        $avatarFiles = File::files(public_path($avatarsPath));
        $randomFile = $avatarFiles[array_rand($avatarFiles)];
        $relativePath = $avatarsPath . '/' . $randomFile->getFilename();
        return url($relativePath);
    }
}
