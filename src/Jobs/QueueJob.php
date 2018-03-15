<?php

namespace Laravel\Health\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueueJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        return true;
    }
}
