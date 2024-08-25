<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Console\Commands\storage\RatesStorageInterface;
use Console_Table;

class ConsoleOutputStorage implements RatesStorageInterface
{
    public function save(array $data): void
    {
        $table = new Console_Table();
        $table->setHeaders($data[0]);

        unset($data[0]);

        foreach ($data as $key) {
            $table->addRow($key);
        }

        print_r($table->getTable());
    }
}
