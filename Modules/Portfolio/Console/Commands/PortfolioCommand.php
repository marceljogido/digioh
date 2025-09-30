<?php

namespace Modules\Portfolio\Console\Commands;

use Illuminate\Console\Command;

class PortfolioCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:PortfolioCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Portfolio Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
