<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Console\Commands\storage\RatesStorageInterface;
use Illuminate\Console\Command;

class ExchangeRateCommand extends Command
{
    protected $signature = 'app:exchange-rates';
    protected $description = 'Powerful service exchange rate';

    private ExchangeServiceInterface $exchangeService;
    private RatesStorageInterface $ratesStorage;

    public function __construct(ExchangeServiceInterface $exchangeService, RatesStorageInterface $ratesStorage)
    {
        parent::__construct();

        $this->exchangeService = $exchangeService;
        $this->ratesStorage = $ratesStorage;
    }

    public function handle(): void
    {
        $data = $this->exchangeService->fetchRates();
        $this->ratesStorage->save($data);
    }
}
