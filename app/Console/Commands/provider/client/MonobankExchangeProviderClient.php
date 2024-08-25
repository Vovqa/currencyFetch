<?php

declare(strict_types=1);

namespace App\Console\Commands\provider\client;

use Illuminate\Support\Facades\Http;

class MonobankExchangeProviderClient implements ExchangeProviderClientInterface
{
    private string $apiUrl = 'https://api.monobank.ua/bank/currency';

    public function getData(): ?array
    {
        $response = Http::get($this->apiUrl);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
