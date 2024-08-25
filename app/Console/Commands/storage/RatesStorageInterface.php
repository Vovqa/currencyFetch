<?php

declare(strict_types=1);

namespace App\Console\Commands\storage;

use App\Console\Commands\dto\RatesDTO;

interface RatesStorageInterface
{
    public function save(RatesDTO $ratesDTO): void;
}
