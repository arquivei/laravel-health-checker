<?php

return [
    'enable' => true,
    /*
     * ====================================================
     * These services in array will be executed in HealthManager,
     * if you don't want to execute all checkers comment the lines bellow.
     * ====================================================
     */
    'services' => [
        'cache' => \Laravel\Health\Checkers\CacheChecker::class,
        'database' => \Laravel\Health\Checkers\DatabaseChecker::class,
        'directory-permission' => \Laravel\Health\Checkers\DirectoryPermissionChecker::class,
        'queue' => \Laravel\Health\Checkers\QueueChecker::class,
    ],
    /*
     * ====================================================
     * IMPORTANT!
     * The resource MUST have the same name of the service
     * ====================================================
     */
    'resources' => [
        'cache' => [
            'messages' => [
                'error' => 'Cache is not return the correct values.'
            ],
            'database' => 'health-cache-check',
            'minutes_expire' => 1,
            'string' => "HEALTH TEST"
        ],
        'database' => [
            'messages' => [
                'error' => 'Database is not working properly.'
            ],
        ],
        'directory-permission' => [
            'dirs' => [
                'storage/',
                'bootstrap/cache/'
            ],
            'messages' => [
                'error' => 'The directory %s is not writable.'
            ],
        ],
        'queue' => [
            'queue-name' => 'health-queue',
            'job' => \Laravel\Health\Jobs\QueueJob::class,
            'connection' => '',
            'error' => 'Queue system is not working.'
        ],
    ]
];
