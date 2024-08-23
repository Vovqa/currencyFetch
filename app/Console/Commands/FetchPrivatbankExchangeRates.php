<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use app\Console\Rates;
use Illuminate\Http\Client\Response;

class FetchPrivatbankExchangeRates extends Command implements Rates
{
    
    protected $signature = 'fetch:exchange-rate';
    protected $description = 'Fetch exchange rates from privat24';


    public function handle(){
       
        $response = Http::get('https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5');
        $this->exchangeRate($response);
        }

    public function exchangeRate($response) {
       
        if($response->successful()) {
            
            $rates = $response->json();
            foreach ($rates as $rate) {
                
                $this->info("Currency: {$rate['ccy']}, Buy: {$rate['buy']}, Sale: {$rate['sale']}");
            }
        } else {
            
            $this->error('Not possible to get privat24 exchange rates');
        }
    }
}
