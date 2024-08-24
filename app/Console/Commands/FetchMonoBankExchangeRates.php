<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Console\ExchangeRates;

class FetchMonobankExchangeRates extends Command implements ExchangeRates
{   
    protected $description = 'Fetch exchange rates from monobank';

    public function getExchangeRates() {

        $response = Http::get('https://api.monobank.ua/bank/currency');
       
        if($response->successful()) {
             
            $rates = $response->json();
          
                $firstRate = $rates[0];
                $secondRate = $rates[1];
                if (isset($firstRate['currencyCodeA'], $firstRate['rateBuy'], $rate['rateSell'], $secondRate['currencyCodeA'], $secondRate['rateBuy'],$secondRate['rateSell'])) {
                $this->info("Currency: {$firstRate['currencyCodeA']}, Buy: {$firstRate['rateBuy']}, Sale: {$firstRate['rateSell']}");
                $this->info("Currency: {$secondRate['currencyCodeA']}, Buy: {$secondRate['rateBuy']}, Sale: {$secondRate['rateSell']}");            
                }
        } else {
            
            $this->error('Failed to fetch monobank exchange rates');
        }
    
        $this->info($this->description);
    }
}


