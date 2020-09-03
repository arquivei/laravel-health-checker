<?php

namespace Laravel\Health\Test;

use Laravel\Health\HealthManager;
use Orchestra\Testbench\TestCase;

class HealthManagerTest extends TestCase
{
    public function testHealthManagerUsingAHealthfulChecker()
    {
        $config = [
            'services' => [
                'fake' => FakeHealthfulChecker::class,
            ],
            'resources' => [
                'fake' => [
                    'messages' => [
                        'error' => 'fake message.'
                    ],
                ],
            ],
        ];
        $healthManager = new HealthManager();
        $healthManager->eagerLoader($config);

        $status = $healthManager->getHealthStatus();

        self::assertTrue($status['fake']->getResponse()['is_healthful']);
        self::assertNull($status['fake']->getResponse()['message']);
    }

    public function testHealthManagerUsingAnUnhealthyChecker()
    {
        $config = [
            'services' => [
                'fake' => FakeUnhealthfulChecker::class,
            ],
            'resources' => [
                'fake' => [
                    'messages' => [
                        'error' => 'unhealthy.'
                    ],
                ],
            ],
        ];
        $healthManager = new HealthManager();
        $healthManager->eagerLoader($config);

        $status = $healthManager->getHealthStatus();

        self::assertFalse($status['fake']->getResponse()['is_healthful']);
        self::assertSame($status['fake']->getResponse()['message'], 'unhealthy');
    }

}
