<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backup-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $databaseName = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $port = env('DB_PORT', '3306');

        $date = now()->format('Y-m-d_H-i-s');
        $backupFile = "backups/{$databaseName}_{$date}.sql";

        //dd(storage_path($backupFile)) ;
        /*        $command = "C:\\laragon\\bin\\mysql\_mysql-8.0.30-winx64\\bin\\mysqldump --user={$username} --password={$password} --host={$host} --port={$port} {$databaseName} > " . storage_path($backupFile);*/

        $command = "C:\\laragon\\bin\\mysql\_mysql-8.0.30-winx64\\bin\\mysqldump --user={$username} --password={$password} --host={$host} --port={$port} {$databaseName} > C:\\laragon\\www\\qcm_app_test_5\\qcm-app\\storage\\backups\\backup_". date('Y-m-d_H-i-s') . ".sql";


        exec($command, $output, $return);

        if ($return === 0) {
            $this->info('Backup successfully created: ' . $backupFile);
        } else {
            $this->error('Backup failed.');
        }
    }
}
