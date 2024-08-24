<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use App\Console\ExchangeRates;

class FetchPrivatbankExchangeRates extends Command implements ExchangeRates
{
    protected $description = 'Fetch exchange rates from PrivatBank';

        public function getExchangeRates() {       
           
            $response = Http::get('https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5');
                   
            if ($response->successful()) {
                $rates = $response->json();
                foreach ($rates as $rate) {
                    if (isset($rate['ccy'], $rate['buy'], $rate['sale'])) {
                    $this->info("Currency: {$rate['ccy']}, Buy: {$rate['buy']}, Sale: {$rate['sale']}");
                    }
                }
            }
             else {
                $this->error('Failed to fetch PrivatBank exchange rates.');   
                }   
        }
    }


