<?php

use Illuminate\Support\Facades\Schedule;


Schedule::command('reports:generate-product-summary --type=daily')
    ->everyMinute()
    ->timezone(config('app.timezone'));
Schedule::command('reports:generate-product-summary --type=daily')
    ->dailyAt('00:05')
    ->timezone(config('app.timezone'));

Schedule::command('reports:generate-product-summary --type=monthly')
    ->everyMinute()
//    ->monthlyOn(1, '00:10')
    ->timezone(config('app.timezone'));
Schedule::command('reports:generate-product-summary --type=yearly')
    ->everyMinute()
//    ->yearlyOn(1, 1, '00:15')
    ->timezone(config('app.timezone'));
// Schedule::command('stock:check')
//     ->everyMinute();
 Schedule::command('stock:check')
     ->everyMinute();
//     ->dailyAt('00:05');
