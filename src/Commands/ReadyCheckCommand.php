<?php

declare(strict_types=1);

namespace Laravel\Health\Commands;

use Illuminate\Console\Command;
use Laravel\Health\Handler\CommandHandler;

class ReadyCheckCommand extends Command
{
    protected $signature = 'application:ready-check';
    protected $description = 'Command to check application readiness';

    public function handle(): void
    {
        CommandHandler::handle();
    }
}
