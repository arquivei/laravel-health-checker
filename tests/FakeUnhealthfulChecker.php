<?php

namespace Laravel\Health\Test;

use Laravel\Health\Checkers\BaseChecker;

class FakeUnhealthfulChecker extends BaseChecker
{

    public function check(): FakeUnhealthfulChecker
    {
        $this->makeResponse('unhealthy', false);
        return $this;
    }
}