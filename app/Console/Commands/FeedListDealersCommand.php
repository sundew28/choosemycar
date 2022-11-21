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
    protected $signature = 'feed:list-dealers-with-cars {--lists=}';

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
        $lists = $this->arguments('lists');
        $this->output->write("<info>$lists</info>");
    }
}
