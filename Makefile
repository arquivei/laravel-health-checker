PHPVERSION ?= 8.0
PHP ?= PHPVERSION=$(PHPVERSION) bin/php
COMPOSER ?= PHPVERSION=$(PHPVERSION) bin/composer

.PHONY: setup
setup: container vendor tests

.PHONY: container
container:
	docker build -t laravel-health-checker --build-arg PHPVERSION=8.2 .docker/

.PHONY: vendor
vendor:
	$(COMPOSER) install

.PHONY: tests
tests:
	$(PHP) vendor/bin/phpunit
