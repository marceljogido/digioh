<?php

namespace Modules\ClientLogo\Console\Commands;

use Illuminate\Console\Command;

class ClientLogoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ClientLogoCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ClientLogo Command description';

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
