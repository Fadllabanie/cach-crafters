<?php

if (!function_exists('formatCurrencyNumber')) {

    function formatCurrencyNumber($number, $decimals = 2, $decimal_separator = '.', $thousands_separator = ',')
    {
        return '$' . number_format($number, $decimals, $decimal_separator, $thousands_separator);
    }
}
