<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use BackupManager\Manager;


class DatabaseBackup extends Controller
{
    public function index(){
        return view('db_backup.index');
    }

    public function __construct(Manager $manager) {
        $this->manager = $manager;
    }
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        $date = Carbon::now()->toW3cString();
        $environment = env('APP_ENV');
        $schedule->command(
            "db:backup --database=mysql --destination=public/ --destinationPath=/{$environment}/projectname_{$environment}_{$date} --compression=gzip"
        )->twiceDaily(13,21);
    }

    public function runBackup(){
        $backup = $this->manager->makeBackup();
        print_r($backup);
    }

}
