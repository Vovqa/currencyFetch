<?php namespace app\Console;

use app\Console\Rates;

interface RatesFactory {

    public function createExchangeRates():Rates;
}