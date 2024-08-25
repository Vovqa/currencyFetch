<?php

declare(strict_types=1);

namespace App\Console\Commands;

interface RatesStorageInterface
{
    public function save(array $data): void;
}
