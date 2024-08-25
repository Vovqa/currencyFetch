<?php

namespace App\Console\Commands\provider\client;

interface ExchangeProviderClientInterface
{
    public function getData(): ?array;
}
