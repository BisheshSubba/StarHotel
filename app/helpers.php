<?php
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

function convertCurrency($amount)
{
    $currency = session('currency', 'NPR'); 

    $rate = Cache::remember('usd_rate', 3600, function () {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/NPR');
        return $response->json()['rates']['USD'] ?? 0.0075;
    });

    return $currency === 'USD' ? round($amount * $rate, 2) : $amount;
}
