<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FeedListDealersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:list-dealers-with-cars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List dealers with car status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         // List the dealers with cars status
        $dealers_results = app()->call('App\Http\Controllers\DealerVehicleController@dealersListData');
        $this->output->write("<info>$dealers_results</info>");
    }
}
