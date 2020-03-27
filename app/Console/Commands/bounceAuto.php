<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class bounceAuto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bounce:auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'automatically retrieve bounces from bounce mailbox and sort/filter';

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
        include(app_path().'/bounces/bounceAuto.php');
    }
}
