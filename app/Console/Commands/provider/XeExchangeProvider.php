<?php

declare(strict_types=1);

namespace App\Console\Commands\provider;

use App\Console\Commands\dto\RatesDTO;
use App\Console\Commands\provider\client\XeExchangeProviderClient;

class XeExchangeProvider implements ExchangeProviderInterface
{
    private XeExchangeProviderClient $client;

    public function __construct(XeExchangeProviderClient $client)
    {
        $this->client = $client;
    }

    public function getRates(): RatesDTO
    {
        print_r($this->client); die;
        // TODO: Implement getRates() method.
    }
}
