<?php

namespace App\Console\Commands;

interface ExchangeProviderInterface
{
    public function getRates(): array;
}
