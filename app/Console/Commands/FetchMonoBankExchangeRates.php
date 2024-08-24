<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Console\ExchangeRates;

class FetchMonoBankExchangeRates extends Command implements ExchangeRates
{
    
    // protected $signature = 'fetch:monobank-rates';
    protected $description = 'Fetch exchange rates from monobank';


    public function getExchangeRates() {

        $response = Http::get('https://api.monobank.ua/bank/currency');
       
        if($response->successful()) {
             
            $rates = $response->json();
          
                $firstRate = $rates[0];
                $secondRate = $rates[1];

                $this->info("Currency: {$firstRate['currencyCodeA']}, Buy: {$firstRate['rateBuy']}, Sale: {$firstRate['rateSell']}");

                $this->info("Currency: {$secondRate['currencyCodeA']}, Buy: {$secondRate['rateBuy']}, Sale: {$secondRate['rateSell']}");            
                
                
        } else {
            
            $this->error('Not possible to get monobank exchange rates');
        }
        if (env('EXCHANGE_RATE_PROVIDER') == "privat24"){
            $this->info('Local Enviroment privat24');
        }
        $this->info($this->description);
    }
}

