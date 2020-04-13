<?php

namespace Laravel\Health\Commands;

use Illuminate\Console\Command;
use Laravel\Health\HealthManager;

class HealthCommand extends Command
{
    protected $signature = 'application-health:check-health';
    protected $description = 'Command to check application health';

    public function handle()
    {
        $healthStatus = (new HealthManager())->eagerLoader(config('health-checker'))
            ->getHealthStatus();

        foreach ($healthStatus as $status) {
            if (!$status->isHealthful()) {
                throw new \Exception('The application is not healthy. Error: ' . $status->getMessage());
            }
        }
    }
}