<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Console\Command\ExchangeRatesInterface;

class FetchMonobankExchangeRates implements ExchangeRatesInterface
{   
    protected $description = 'Fetch exchange rates from monobank';

    public function getExchangeRates() {

        $response = Http::get('https://api.monobank.ua/bank/currency');
       
        if($response->successful()) {
             
            $rates = $response->json();
          
                $firstRate = $rates[0];
                $secondRate = $rates[1];
                // if (isset($firstRate['currencyCodeA'], $firstRate['rateBuy'], $rate['rateSell'])) {
                    print_r("Currency: {$firstRate['currencyCodeA']}, Buy: {$firstRate['rateBuy']}, Sale: {$firstRate['rateSell']}");
                    print_r("Currency: {$secondRate['currencyCodeA']}, Buy: {$secondRate['rateBuy']}, Sale: {$secondRate['rateSell']}");            
                // }
        } else {
            
            print_r('Failed to fetch monobank exchange rates');
        }
    
        print_r($this->description);
    }
}


