<?php

namespace Laravel\Health\Facades;

use Illuminate\Support\Facades\Facade;

class HealthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-health-checker';
    }
}
