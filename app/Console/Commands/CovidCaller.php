<?php

namespace App\Console\Commands;

use App\Http\Controllers\COVIDController;
use Illuminate\Console\Command;

class CovidCaller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'covid:collect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        return COVIDController::covidHeartBeat();
    }
}
