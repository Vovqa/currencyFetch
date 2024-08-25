<?php

declare(strict_types=1);

namespace App\Console\Commands\provider;

use App\Console\Commands\dto\RatesDTO;
use App\Console\Commands\provider\client\MonobankExchangeProviderClient;

class MonobankExchangeProvider implements ExchangeProviderInterface
{
    private MonobankExchangeProviderClient $client;

    public function __construct(MonobankExchangeProviderClient $client)
    {
        $this->client = $client;
    }

    public function getRates(): RatesDTO
    {
        $result = $this->client->getData();

        $body = [];

        foreach ($result as $item) {
            if (!in_array($item['currencyCodeA'], ['978', '980', '840'])) {
                continue;
            }

            $body[] = [
                'currencyCodeA' => $item['currencyCodeA'],
                'currencyCodeB' => $item['currencyCodeB'],
                'rateBuy' => $item['rateBuy'],
                'rateSell' => $item['rateSell'],
            ];
        }

        return new RatesDTO($body);
    }
}
