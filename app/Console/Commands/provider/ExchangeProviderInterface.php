<?php

namespace App\Console\Commands\provider;

use App\Console\Commands\dto\RatesDTO;

interface ExchangeProviderInterface
{
    public function getRates(): RatesDTO;
}
