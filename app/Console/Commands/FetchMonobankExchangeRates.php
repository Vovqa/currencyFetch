<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use app\Console\Rates;
use Illuminate\Http\Client\Response;

class FetchMonobankExchangeRates extends Command implements Rates
{
    
    protected $signature = 'fetch:exchange-rate-mono';
    protected $description = 'Fetch exchange rates from monobank';


    public function handle(){
       
        $response = Http::get('https://api.monobank.ua/bank/currency');
        $this->exchangeRate($response);
        }

    public function exchangeRate($response) {
       
        if($response->successful()) {
             
            $rates = $response->json();
          
                $firstRate = $rates[0];
                $secondRate = $rates[1];

                $this->info("Currency: {$firstRate['currencyCodeA']}, Buy: {$firstRate['rateBuy']}, Sale: {$firstRate['rateSell']}");

                $this->info("Currency: {$secondRate['currencyCodeA']}, Buy: {$secondRate['rateBuy']}, Sale: {$secondRate['rateSell']}");            
            
        } else {
            
            $this->error('Not possible to get monobank exchange rates');
        }
    }
}

