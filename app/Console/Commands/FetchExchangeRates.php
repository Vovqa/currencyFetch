<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\FetchMonobankExchangeRates;
use App\Console\Commands\FetchPrivatbankExchangeRates;

class FetchExchangeRates extends Command
{
    protected $signature = 'app:fetch-exchange-rates';
    protected $description = 'Fetch exchange rates from the specified provider';

    public function handle()
    {
    
        $this->getRates();
    }

    public function getRates()
    {
        $provider = env('EXCHANGE_RATE_PROVIDER');

        switch ($provider) {
            case "privat24":
                $rates = new FetchPrivatbankExchangeRates();
                $rates->getExchangeRates();
                break;

            case "mono":
                $rates = new FetchMonoBankExchangeRates();
                $rates->getExchangeRates();
                break;

            default:
                print_r('No provider available');
                break;
        }
    }
}
