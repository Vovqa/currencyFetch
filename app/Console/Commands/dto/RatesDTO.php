<?php

declare(strict_types=1);

namespace App\Console\Commands\dto;

class RatesDTO
{
    private array $headers = ['Currency', 'Base', 'Buy', 'Sale'];
    private array $body;

    public function __construct(array $body)
    {
        $this->body = $body;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }
}
