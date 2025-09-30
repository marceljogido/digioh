<?php

namespace Modules\OurWork\Console\Commands;

use Illuminate\Console\Command;

class OurWorkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:OurWorkCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'OurWork Command description';

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
