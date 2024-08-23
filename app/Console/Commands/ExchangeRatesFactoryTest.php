<?php
namespace DesignPatterns\Creational\FactoryMethod\Tests;

use app\Console\RatesFactory;
use app\Console\Rates;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{
    public function testCanCreateExhcangeRatesPrivat()
    {
        $ratesFactory = new PrivateRatesCreatorFactory();
        $rates = $ratesFactory->createExchangeRates();

        $this->assertInstanceOf(FetchPrivatbankExchangeRates::class, $rates);
    }

    public function testCanCreateExhcangeRatesMono()
    {
        $ratesFactory = new MonoRatesCreatorFactory();
        $rates = $ratesFactory->createExchangeRates();

        $this->assertInstanceOf(FetchMonobankExchangeRates::class, $rates);
    }
}