<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use App\Console\Commands\ExchangeRatesInterface;
use Console_Table;

class FetchFixerExchangeRates implements ExchangeRatesInterface
{

    protected $description = 'Fetch exchange rates from Fixer';



    public function getExchangeRates()
    {

        $response = Http::get('https://data.fixer.io/api/latest?access_key=953516850a04408fb7a9871f1989706d');

        $table = new Console_Table();
        $table->setHeaders(['Base EUR', 'Base UA', 'Rate']);

        if ($response->successful()) {

            $rates = $response->json();
            if (isset($rates['base'], $rates['rates']['EUR'])) {
                print_r("Currency: {$rates['base']}, Rates: {$rates['rates']['UAH']}");
                $table->addRow([$rates['base'], 'UAH', $rates['rates']['UAH']]);
            } else {
                print_r('Failed to fetch Fixer exchange rates');
            }
        }
        print_r($table->getTable());
        print_r($this->description);
    }
}
