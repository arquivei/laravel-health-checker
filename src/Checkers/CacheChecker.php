<?php

namespace Laravel\Health\Checkers;

use Illuminate\Support\Facades\Cache;

class CacheChecker extends BaseChecker
{
    public function check() : CacheChecker
    {
        try {
            $cachedInfo1 = $this->getCached();
            $cachedInfo2 = $this->getCached();

            if ($cachedInfo1 !== $cachedInfo2 || $cachedInfo2 !== $this->getCached()) {
                $this->makeResponse($this->resources['messages']['error'], false);
            }
            $this->makeResponse(null, true);
        } catch (\Exception $exception) {
            $this->makeResponse($exception->getMessage(), false);
        } finally {
            return $this;
        }
    }

    public function getCached()
    {
        return Cache::remember(
            $this->resources['database'],
            $this->resources['minutes_expire'],
            function () {
                return $this->resources['string'];
            }
        );
    }
}
