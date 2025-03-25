<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

#[AsCommand(name: 'backup:database')]
class BackupDatabase extends Command
{
    protected $description = 'Effectue une sauvegarde de la base de données';

    public function handle()
    {
        $filename = storage_path('backups/backup_' . date('Y-m-d_H-i-s') . '.sql');

        $command = "mysqldump -u root -pYOUR_PASSWORD qcm_db > $filename";

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info("Sauvegarde réussie : $filename");
        } else {
            $this->error("Erreur lors de la sauvegarde.");
        }
    }
}
