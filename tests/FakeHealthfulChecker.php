<?php

namespace Laravel\Health\Test;

use Laravel\Health\Checkers\BaseChecker;

class FakeHealthfulChecker extends BaseChecker
{

    public function check(): FakeHealthfulChecker
    {
        $this->makeResponse(null, true);
        return $this;
    }
}