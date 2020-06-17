<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DropTablesDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sloncorp:drop {--force=no}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drops all tables';

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

        $force = $this->option('force');

        if ($force !== 'yes' && !$this->confirm('CONFIRM DROP AL TABLES IN THE CURRENT DATABASE? [y|N]')) {
            exit(PHP_EOL. 'Drop Tables command aborted' . PHP_EOL);
        }

        $colName = 'Tables_in_' . env('DB_DATABASE');

        $tables = DB::select('SHOW TABLES');

        if(count($tables) > 0) {
            $dropList = [];
            foreach($tables as $table) {

                $dropList[] = $table->$colName;

            }
            $dropList = implode(',', $dropList);

            DB::beginTransaction();

            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::statement("DROP TABLE $dropList");
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            DB::commit();
        }

        $this->comment(PHP_EOL . "All tables were dropped" . PHP_EOL);
    }
}
