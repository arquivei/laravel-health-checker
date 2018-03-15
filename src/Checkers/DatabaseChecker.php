<?php

namespace Laravel\Health\Checkers;

use Illuminate\Support\Facades\Cache;

class DatabaseChecker extends BaseChecker
{
    public function check() : DatabaseChecker
    {
        try {
            $db = \DB::connection()->getPdo();

            $this->makeResponse(null, true);
        } catch (\Exception $exception) {
            $this->makeResponse($exception->getMessage(), false);
        } finally {
            return $this;
        }
    }
}
