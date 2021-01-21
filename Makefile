PHPVERSION ?= 7.3
PHP ?= PHPVERSION=$(PHPVERSION) bin/php
COMPOSER ?= PHPVERSION=$(PHPVERSION) bin/composer

.PHONY: setup
setup: container vendor tests

.PHONY: container
container:
	docker build -t laravel-health-checker:7.3 --build-arg PHPVERSION=7.3 .docker/
	docker build -t laravel-health-checker:7.4 --build-arg PHPVERSION=7.4 .docker/
	docker build -t laravel-health-checker:8.0 --build-arg PHPVERSION=8.0 .docker/

.PHONY: vendor
vendor:
	$(COMPOSER) install

.PHONY: tests
tests:
	$(PHP) vendor/bin/phpunit
