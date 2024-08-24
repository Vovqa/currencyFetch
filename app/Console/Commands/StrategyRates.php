<?php

use Illuminate\Console\Command;
use App\Console\FetchMonoBankExchangeRates;
use App\Console\FetchPrivatbankExchangeRates;

class StategyRates extends Command {

    protected $signature = 'fetch:exchange-rates';

    protected $description = 'Fetch exchange rates from the specified provider';

   
    public function handle(){
    
        $this->getRates();
    }

    public function getRates () {


    $provider = env('EXCHANGE_RATE_PROVIDER');

    switch ($provider) {
        case "privat24":
            $rates = new FetchMonoBankExchangeRates();
            $rates->getExchangeRates();
            break;

        case "mono":
            $rates = new FetchPrivatbankExchangeRates();
            $rates->getExchangeRates();
            break;

        default:
        $this->info("Any provider not available");
            break;
    
        }
    }       
}

