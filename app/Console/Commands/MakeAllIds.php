<?php

namespace App\Console\Commands;

use App\Models\Thankful;
use Hashids\Hashids;
use Illuminate\Console\Command;

class MakeAllIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arsanandha:genurlid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all URLs ID';

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
     * @return void
     */
    public function handle()
    {
        /** @var $thankful
         * get from thankful table and create all unique ids url in table
         */
        $thankful = Thankful::all()->where("url_id",null);
        foreach($thankful as $t){
            $t_update = Thankful::find($t->id);
            $id_gen = new Hashids(Thankful::class,10);
            $t_update->url_id = $id_gen->encode($t->id);
            $t_update->save();
        }
        return $this->info("Updated for ". $thankful->count() . " Items.");
    }
}
