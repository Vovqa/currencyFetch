<?php

declare(strict_types=1);

namespace App\Console\Commands\provider;

use App\Console\Commands\dto\RatesDTO;
use App\Console\Commands\provider\client\PrivatbankExchangeProviderClient;

class PrivatbankExchangeProvider implements ExchangeProviderInterface
{
    private PrivatbankExchangeProviderClient $client;

    public function __construct(PrivatbankExchangeProviderClient $client)
    {
        $this->client = $client;
    }

    public function getRates(): RatesDTO
    {
        $result = $this->client->getData();

        return new RatesDTO($result);
    }
}
