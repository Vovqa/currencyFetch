<?php

namespace App\Console\Commands;

use App\Console\Commands\provider\ExchangeProviderInterface;

readonly class ExchangeService implements ExchangeServiceInterface
{
    private ExchangeProviderInterface $exchangeProvider;

    public function __construct(ExchangeProviderInterface $exchangeProvider)
    {
        $this->exchangeProvider = $exchangeProvider;
    }

    public function fetchRates(): dto\RatesDTO
    {
        return $this->exchangeProvider->getRates();
    }
}
