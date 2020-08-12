<?php

namespace Laravel\Health\Test\Handler;

use Laravel\Health\Handler\CommandHandler;
use Laravel\Health\Test\FakeHealthfulChecker;
use Laravel\Health\Test\FakeUnhealthfulChecker;
use Orchestra\Testbench\TestCase;

class CommandHandlerTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('health-checker', [
            'services' => [
                'healthy' => FakeHealthfulChecker::class,
                'unhealthy' => FakeUnhealthfulChecker::class,
            ],
            'resources' => [
                'healthy' => [
                    'messages' => [
                        'error' => 'healthy message.'
                    ],
                ],
                'unhealthy' => [
                    'messages' => [
                        'error' => 'unhealthy message.'
                    ],
                ],
            ],
        ]);
    }

    public function testHandleWithUnhealthyService()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The application is not healthy. Error: unhealthy');

        CommandHandler::handle();
    }
}
