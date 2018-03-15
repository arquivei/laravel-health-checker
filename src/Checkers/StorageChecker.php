<?php

namespace Laravel\Health\Checkers;

use Illuminate\Queue\Worker;
use Illuminate\Queue\WorkerOptions;
use Illuminate\Support\Facades\Cache;
use Laravel\Health\Jobs\QueueJob;

class StorageChecker extends BaseChecker
{
    public function check() : StorageChecker
    {
        try {

            Storage::disk($this->resources['driver'])
                ->put(
                    $this->resources['filename'],
                    $this->resources['contents']
                );

            $contents = Storage::disk($this->resources['driver'])->get($this->resources['filename']);

            Storage::disk($this->resources['driver'])->delete($this->resources['filename']);

            if ($contents !== $this->resource['contents']) {
                return $this->makeResponse($this->resources['messages']['error'], false);
            }

            $this->makeResponse(null, true);
        } catch (\Exception $exception) {
            $this->makeResponse($exception->getMessage(), false);
        } finally {
            return $this;
        }
    }
}
