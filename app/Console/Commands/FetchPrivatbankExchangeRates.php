<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use App\Console\Commands\ExchangeRatesInterface;
use Console_Table;

class FetchPrivatbankExchangeRates implements ExchangeRatesInterface
{

    protected $description = 'Fetch exchange rates from PrivatBank';

    public function getExchangeRates()
    {
        $response = Http::get('https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5');

        $table = new Console_Table();
        $table->setHeaders(['Currency', 'Buy', 'Sale']);

        if ($response->successful()) {
            $rates = $response->json();
            foreach ($rates as $rate) {
                if (isset($rate['ccy'], $rate['buy'], $rate['sale'])) {
                    $table->addRow([$rate['ccy'], $rate['buy'], $rate['sale']]);
                }
            }
        } else {
            print_r('Failed to fetch Privat rates.');
        }
        print_r($table->getTable());
        print_r($this->description);
    }
}
