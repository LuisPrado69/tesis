<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedDataBase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sloncorp:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs seeder and migrations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $env = env('APP_ENV');
        if($env !== 'local')
            exit(PHP_EOL. 'Drop Tables command aborted' . PHP_EOL);

        if (!$this->confirm('CONFIRM DROP AL TABLES IN THE CURRENT DATABASE, MIGRATE AND SEED? [y|N]')) {
            exit(PHP_EOL. 'Command can only be executed in local environment. Check APP_ENV variable' . PHP_EOL);
        }

        Artisan::call('sloncorp:drop', array('--force' => 'yes'));

        Artisan::call('migrate', array('--path' => 'database/migrations/acl/'));
        Artisan::call('migrate', array('--path' => 'database/migrations/queue/'));
        Artisan::call('migrate', array('--path' => 'database/migrations/system/'));
        Artisan::call('migrate', array('--path' => 'database/migrations/business/'));

        Artisan::call('db:seed', array('--class' => '_System'));
        Artisan::call('db:seed', array('--class' => '_Business'));
        Artisan::call('db:seed', array('--class' => '_Examples'));

        $this->comment(PHP_EOL."Migration and Seeder successful".PHP_EOL);
    }
}