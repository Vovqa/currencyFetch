<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use App\Console\ExchangeRates;

class FetchPrivatbankExchangeRates extends Command implements ExchangeRates
{
   
    protected $description = 'Fetch exchange rates from PrivatBank';

    public function testErrorResponse()  
    {  
        
         Http::fake([  
            'api.privatbank.ua/p24api/pubinfo*' => Http::response([], 404), 
        ]);  
    
        
        $response = Http::get('https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5');  
    
       
        $this->info($response->status());

        return $response;
    }  

        public function getExchangeRates() {

        $response = $this->testErrorResponse();
        
        try {
            $response = Http::get('https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5');
            $status=$response->status();

            
            if ($response->successful()) {
                $rates = $response->json();
                foreach ($rates as $rate) {
                    $this->info("Currency: {$rate['ccy']}, Buy: {$rate['buy']}, Sale: {$rate['sale']}");
                }
            } else {
                $this->error('Failed to fetch PrivatBank rates.');
                $monobankCommand = new FetchMonoBankExchangeRates();
                $monobankCommand->handle();
            }
        } catch (ConnectionException $e) {
            $this->error("Error occurred: " . $e->getMessage());
            $this->warn("Switching to FetchMonoBankExchangeRates...");

            // Вызов другого класса
            $monobankCommand = new FetchMonoBankExchangeRates();
            $monobankCommand->handle();
        }
    }
}


// class FetchMonoBankExchangeRates extends Command
// {
//     protected $signature = 'fetch:monobank-rates';
//     protected $description = 'Fetch exchange rates from Monobank';

//     public function handle()
//     {
//         $response = Http::get('https://api.monobank.ua/bank/currency');

//         if ($response->successful()) {
//             $rates = $response->json();
//             // Обработка данных Monobank API
//             foreach ($rates as $rate) {
//                 if (isset($rate['currencyCodeA'], $rate['rateBuy'], $rate['rateSell'])) {
//                     $this->info("Currency: {$rate['currencyCodeA']}, Buy: {$rate['rateBuy']}, Sale: {$rate['rateSell']}");
//                 }
//             }
//         } else {
//             $this->error('Failed to fetch Monobank rates.');
//         }
//     }
// }
