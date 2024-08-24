<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
   
    
    protected $commands = [
        //   \App\Console\Commans\FetchPrivatbankExchangeRates::class,
        //   \App\Console\Commands\FetchMonoBankExchangeRates::class,
        \App\Console\Commands\StategyRates::class,
    ];

    
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
