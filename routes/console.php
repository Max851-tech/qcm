<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


use App\Console\Commands\BackupDatabase;

Artisan::command('backup:database')->purpose('Effectue une sauvegarde de la base')->weekly();
