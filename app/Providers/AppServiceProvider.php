<?php

namespace App\Providers;

use App\Console\Commands\ExchangeService;
use App\Console\Commands\ExchangeServiceInterface;
use App\Console\Commands\provider\client\XeExchangeProviderClient;
use App\Console\Commands\provider\ExchangeProviderInterface;
use App\Console\Commands\provider\MonobankExchangeProvider;
use App\Console\Commands\provider\PrivatbankExchangeProvider;
use App\Console\Commands\provider\XeExchangeProvider;
use App\Console\Commands\storage\ConsoleOutputStorage;
use App\Console\Commands\storage\RatesStorageInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExchangeServiceInterface::class, ExchangeService::class);
        $this->app->bind(RatesStorageInterface::class, ConsoleOutputStorage::class);

        $this->app->bind(ExchangeProviderInterface::class, XeExchangeProvider::class);

        $this->app->bind(XeExchangeProviderClient::class, function () {
            return new XeExchangeProviderClient(config('services.xe.id'), config('services.xe.key'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
