<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use App\Console\Commands\ExchangeRatesInterface;
use Console_Table;

class FetchMonobankExchangeRates implements ExchangeRatesInterface
{
    protected $description = 'Fetch exchange rates from monobank';

    public function getExchangeRates()
    {

        $response = Http::get('https://api.monobank.ua/bank/currency');

        if ($response->successful()) {

            $table = new Console_Table();
            $table->setHeaders(['CurrencyCodeA', 'CurrencyCodeB', 'rateBuy', 'rateSell']);

            $rates = $response->json();

            $firstRate = $rates[0];
            $secondRate = $rates[1];
        
            if (isset($firstRate['currencyCodeA'], $firstRate['currencyCodeB'], $firstRate['rateBuy'], $firstRate['rateSell'])) {
                $table->addRow([$firstRate['currencyCodeA'], $firstRate['rateBuy'], $firstRate['rateSell'], $firstRate['rateSell']]);
                $table->addRow([$secondRate['currencyCodeA'], $secondRate['rateBuy'], $secondRate['rateSell'], $secondRate['rateSell']]);
                
            } else {

                print_r('Failed to fetch monobank exchange rates');
            }
            print_r($table->getTable());
            print_r($this->description);
        }
    }
}

