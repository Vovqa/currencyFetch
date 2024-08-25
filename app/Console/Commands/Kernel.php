<?php

namespace App\Console;

use App\Console\Commands\FetchExchangeRates;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    
    protected $commands = [
            \app\Console\Commands\FetchExchangeRates::class,
        
    ];

    
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
