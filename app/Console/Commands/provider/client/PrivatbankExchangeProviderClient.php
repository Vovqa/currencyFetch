<?php

declare(strict_types=1);

namespace App\Console\Commands\provider\client;

use Illuminate\Support\Facades\Http;

class PrivatbankExchangeProviderClient implements ExchangeProviderClientInterface
{
    private string $apiUrl = 'https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5';

    public function getData(): ?array
    {
        $response = Http::get($this->apiUrl);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
