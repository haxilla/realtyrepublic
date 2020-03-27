<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class retsCronStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rets:cronstart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synch RETS data to local database';

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
        include(app_path().'/rets/cron/cronStart.php');
    }
}
