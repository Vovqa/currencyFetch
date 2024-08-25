<?php

declare(strict_types=1);

namespace App\Console\Commands\provider\client;

class XeExchangeProviderClient implements ExchangeProviderClientInterface
{
    protected string $apiId;
    protected string $apiKey;
    protected string $baseUrl = 'https://xecdapi.xe.com/v1/';

    public function __construct(string $apiId, string $apiKey)
    {
        $this->apiId = $apiId;
        $this->apiKey = $apiKey;
    }

    public function getData(): ?array
    {
        // TODO: Implement getData() method.
    }
}
