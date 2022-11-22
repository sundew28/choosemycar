<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FeedProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:process {--dealers==} {--vehicles==}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract data from XML or JSON files';

    /**
     * Execute the console command.
     *
     * @output string $dealers_results $vehicles_results
     */
    public function handle()
    {
        // grab the file names if provided
        $dealers = $this->option('dealers');
        $vehicles = $this->option('vehicles');

        // Process the dealers file XML or JSON
        $dealers_results = isset($dealers) ? app()->call('App\Http\Controllers\DealerVehicleController@dealersExtractData', ['filename' => $dealers]) : 'No file input';
        // Process the vehicles file XML or JSON
        $vehicles_results = isset($vehicles) ? app()->call('App\Http\Controllers\DealerVehicleController@vehiclesExtractData', ['filename' => $vehicles]) : 'No file input';

        // Ouput the dealers results
        $this->output->write("<info>$dealers_results</info>\n\n");
        // Ouput the vehicles results
        $this->output->write("<info>$vehicles_results</info>\n\n");
        
    }
}
