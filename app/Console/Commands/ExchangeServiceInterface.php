<?php

namespace App\Console\Commands;

use App\Console\Commands\dto\RatesDTO;

interface ExchangeServiceInterface
{
    public function fetchRates(): RatesDTO;
}
