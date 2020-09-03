<?php

namespace Laravel\Health\Handler;

use Laravel\Health\HealthManager;

class CommandHandler
{
    public static function handle(): void
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