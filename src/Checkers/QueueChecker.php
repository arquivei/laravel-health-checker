<?php

namespace Laravel\Health\Checkers;

use Illuminate\Queue\Worker;
use Illuminate\Queue\WorkerOptions;
use Illuminate\Support\Facades\Cache;
use Laravel\Health\Jobs\QueueJob;

class QueueChecker extends BaseChecker
{
    public function check() : QueueChecker
    {
        try {

            \Queue::pushOn($this->resources['queue-name'], new QueueJob());

            $connection = $this->resources['connection'] ?: config('queue.default');

            $queue = config("queue.connections.{$connection}.queue");

            $worker = new Worker();

            $worker->setCache('cache')->driver();

            $q = $worker->runNextJob($connection, $queue, new WorkerOptions([0,0]));

            $this->makeResponse(null, true);
        } catch (\Exception $exception) {
            $this->makeResponse($exception->getMessage(), false);
        } finally {
            return $this;
        }
    }
}
