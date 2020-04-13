# Laravel Health Check

## Install

    composer require arquivei/laravel-health-checker

## Usage
Edit the config file `config/health-checker.php` see the comments there for more information

## Available checkers
- `database` Tests database connections.
- `cache` Tests for caching data
- `directory-permission` Tests permission in directories
- `queue` Tests for queue

## How to add a new checker
You only need to extent `\Laravel\Health\Checkers\BaseChecker` and add to services in `config/health-checker.php`.

## Routes and Responses

To access the health status you can use the follow routes:

- `health/status` Load and list all check services.
- `health\{service_name}\status` Load only the chosen service and show his status. 

The response for both cases will be like that:

```
{
    status: {
        code: 200,
        message: "OK"
    },
    health_status: [
        {
            cache: {
                is_healthful: true,
                message: null
            }
        },
        {
            database: {
                is_healthful: true,
                message: null
            }
        },
        {
            directory-permission: {
                is_healthful: false,
                message: "The directory /application/public/../storage/ is not writable."
            }
        },
        {
            queue: {
                is_healthful: true,
                message: null
            }
        }
    ]
}
```

## Command usage

You can use de command `application-health:check-health` to check health in your cli application
