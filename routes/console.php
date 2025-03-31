<?php

use App\Console\Commands\BackupDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


// Inspire command (this one looks good)
Artisan::command('inspire', function () {
$this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('backup:database', function () {
    $this->call(\App\Console\Commands\BackupDatabase::class);
});

// Planification de la commande pour qu'elle s'exécute tous les jours
Schedule::command('backup:database')->daily();

