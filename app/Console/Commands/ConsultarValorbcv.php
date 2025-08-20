<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\Servicios\Consultabcv;

class ConsultarValorbcv extends Command
{
    use Consultabcv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:consultar-valorbcv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'consultar el valor del dolar segun BCV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->consultarelvalordelusd();
        $this->info('Registros del valor del bcv');
    }
}
