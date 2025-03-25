<?php

use App\Console\Commands\BackupDatabase;
use Illuminate\Support\Facades\Artisan;

// Inspire command (this one looks good)
Artisan::command('inspire', function () {
$this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Backup database command (add a closure to define the command's behavior)
Artisan::command('backup:database', function () {
// Add logic for database backup here
$this->info('Database backup logic goes here.');
})->purpose('Effectue une sauvegarde de la base')->weekly();
