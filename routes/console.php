<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\ConsultarValorbcv;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Consultar el valor del dolar segun el BCV
Schedule::command(ConsultarValorbcv::class)->everyThirtyMinutes();