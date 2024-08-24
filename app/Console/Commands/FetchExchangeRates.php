<?php

namespace App\Console;

use Illuminate\Console\Command;
use App\Console\FetchMonobankExchangeRates;
use App\Console\FetchPrivatbankExchangeRates;

class FetchExchangeRates extends Command
{
    protected $signature = 'app:fetch-exchange-rates';
    protected $description = 'Fetch exchange rates from the specified provider';

    public function handle()
    {
        printr("test");
        $fetchRates = new FetchPrivatbankExchangeRates();
        $rate = $fetchRates->handle();
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
                $this->info('No provider available');
                break;
        }
    }
}
