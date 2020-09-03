<?php

namespace Laravel\Health\Commands;

use Illuminate\Console\Command;
use Laravel\Health\Handler\CommandHandler;

class CheckHealthCommand extends Command
{
    protected $signature = 'application-health:check-health';
    protected $description = 'Command to check application health';

    public function handle()
    {
        CommandHandler::handle();
    }
}