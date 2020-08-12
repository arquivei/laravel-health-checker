<?php

namespace Laravel\Health\Commands;

use Illuminate\Console\Command;
use Laravel\Health\Handler\CommandHandler;

class HealthCheckCommand extends Command
{
    protected $signature = 'application:health-check';
    protected $description = 'Command to check application health';

    public function handle()
    {
        CommandHandler::handle();
    }
}