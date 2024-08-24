<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use App\Console\Command\ExchangeRatesInterface;

class FetchPrivatbankExchangeRates implements ExchangeRatesInterface
{
    protected $description = 'Fetch exchange rates from PrivatBank';

        public function getExchangeRates() {       
           
            $response = Http::get('https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5');
                   
            if ($response->successful()) {
                $rates = $response->json();
                foreach ($rates as $rate) {
                    if (isset($rate['ccy'], $rate['buy'], $rate['sale'])) {
                    print_r("Currency: {$rate['ccy']}, Buy: {$rate['buy']}, Sale: {$rate['sale']}");
                    }
                }
            }
             else {
                print_r('Failed to fetch PrivatBank exchange rates.');   
                }   
        }
    }


