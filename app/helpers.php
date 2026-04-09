<?php

use Symfony\Component\Intl\Currencies;

if (!function_exists('all_currencies')) {
    function all_currencies()
    {
        $currencies = [];

        foreach (Currencies::getNames() as $code => $name) {
            $currencies[$code] = [
                'name' => $name,
                'symbol' => Currencies::getSymbol($code),
            ];
        }

        return $currencies;
    }
}

if (!function_exists('currency_symbol')) {
    function currency_symbol($currency = null)
    {
        $currency = $currency ?? auth()->user()?->currency ?? 'NGN';

        return Currencies::getSymbol($currency);
    }
}




if (!function_exists('money')) {
    function money($amount, $decimals = 2, $currency = null)
    {
        // Safe currency resolution
        $currency = $currency 
            ?? auth()->user()?->currency 
            ?? 'NGN';

        // Safe symbol fallback
        try {
            $symbol = Currencies::getSymbol($currency);
        } catch (\Exception $e) {
            $symbol = '₦'; // fallback
        }

        // Format number safely
        $formatted = number_format((float) $amount, $decimals);

        return $symbol . $formatted;
    }
}