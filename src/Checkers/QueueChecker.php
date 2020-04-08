<?php

namespace Laravel\Health\Checkers;

use App\Exceptions\Handler;
use Illuminate\Container\Container;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\QueueManager;
use Illuminate\Queue\QueueServiceProvider;
use Illuminate\Queue\Worker;
use Illuminate\Queue\WorkerOptions;
use Illuminate\Support\Facades\Cache;
use Laravel\Health\Jobs\QueueJob;

class QueueChecker extends BaseChecker
{
    public function check(): QueueChecker
    {
        try {
            $queue = $this->resources['queue-name'] ?: 'health-check';

            \Queue::pushOn($queue, new QueueJob());

            $connection = $this->resources['connection'] ?: config('queue.default');

            \Artisan::call('queue:work', [$connection, '--queue' => $queue, '--once' => true]);

            $this->makeResponse(null, true);
        } catch (\Throwable $exception) {
            $this->makeResponse($exception->getMessage(), false);
        } finally {
            return $this;
        }
    }
}
