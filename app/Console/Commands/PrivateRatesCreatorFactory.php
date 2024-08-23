<?php

use app\Console\RatesFactory;
use app\Console\Rates;

class PrivateRatesCreatorFactory implements RatesFactory{

public function createExchangeRates():Rates {

    return new FetchPrivatbankExchangeRates();

    }

}
