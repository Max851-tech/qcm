<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Sauvegarde la base de données dans le dossier database/backups/';

    public function handle()
    {
        $filename = 'backup_' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        $path = database_path('backups/' . $filename);

        $db_host = env('DB_HOST', '127.0.0.1');
        $db_name = env('DB_DATABASE', 'forge');
        $db_user = env('DB_USERNAME', 'root');
        $db_pass = env('DB_PASSWORD', '');

        $command = "mysqldump --host={$db_host} --user={$db_user} --password={$db_pass} {$db_name} > {$path}";

        $result = system($command);

        if ($result === false) {
            $this->error('Échec de la sauvegarde.');
        } else {
            $this->info("Sauvegarde réussie : {$path}");
        }
    }
}
