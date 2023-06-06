# Laravel Health Checker

## Version Compatibility

| Releases | Laravel          |
|:---------|:-----------------|
| 1.x      | ^5.7             |
| 2.x      | ^7.30.3; ^8.22.1 |
| 3.x      | ^8.22.1; ^9.3.0  |
| 4.x      | ^10.0            |

## Install

```shell script
composer require arquivei/laravel-health-checker
```

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
- `health/{service_name}/status` Load only the chosen service and show his status.

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

You can use the follow commands to check healthy in your cli application:

```sh
php artisan application-health:check-health
```
Or

```sh
php artisan application:health-check
```

## Development

We provide docker images to help set up the development environment.
So, in order to build the images, install the dependencies and run the
tests, you may execute the command:

```shell
make
```

After the initial setup you can use the `bin/php` and `bin/composer`
scripts (wrappers for the docker images) to run the tests and install
new dependencies.
