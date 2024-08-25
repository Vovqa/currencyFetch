<?php

declare(strict_types=1);

namespace App\Console\Commands\storage;

use App\Console\Commands\dto\RatesDTO;
use Console_Table;

class ConsoleOutputStorage implements RatesStorageInterface
{
    public function save(RatesDTO $ratesDTO): void
    {
        $table = new Console_Table();
        $table->setHeaders($ratesDTO->getHeaders());

        foreach ($ratesDTO->getBody() as $row) {
            $table->addRow($row);
        }

        print_r($table->getTable());
    }
}
