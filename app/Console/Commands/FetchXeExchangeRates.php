<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use App\Console\Commands\ExchangeRatesInterface;
use Console_Table;

class FetchXeExchangeRates implements ExchangeRatesInterface
{

    protected $description = 'Fetch exchange rates from XE';

    protected $apiId;
    protected $apiKey;
    protected $baseUrl = 'https://xecdapi.xe.com/v1/';

    public function __construct()
    {
        $this->apiId = config('services.xe.id');
        $this->apiKey = config('services.xe.key');
    }

    public function authorize()
    {
        return Http::withBasicAuth($this->apiId, $this->apiKey)
            ->get($this->baseUrl . 'currencies');
    }

    public function getExchangeRates()
    {

        $response = $this->authorize();

        if ($response->successful()) {
            $rates = $response->json();

            $table = new Console_Table();
            $table->setHeaders(['ISO', 'Currency Name', 'Is Obsolete']);

            foreach ($rates['currencies'] as $currency) {
                if ($currency['iso'] === 'AED') {
                    $table->addRow([$currency['iso'], $currency['currency_name'], $currency['is_obsolete'] ? 'true' : 'false']);
                } 
            }        
        }
        else {
            print_r('Failed to fetch XE rates.');
        }
        print_r($table->getTable());
        print_r($this->description);
    }
}
