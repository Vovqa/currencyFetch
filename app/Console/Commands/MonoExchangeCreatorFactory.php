<?php

use app\Console\RatesFactory;
use app\Console\Rates;

class MonoExchangeCreatorFactory implements RatesFactory{

public function createExchangeRates():Rates {

    return new FetchMonobankExchangeRates();

    }

}
