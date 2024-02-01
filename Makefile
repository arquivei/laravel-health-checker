MKFILE_PATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PROJECT_DIR := $(dir $(MKFILE_PATH))

include $(PROJECT_DIR).env.dist

PHPVERSION ?= 8.2
PHP ?= PHPVERSION=$(PHPVERSION) bin/php
COMPOSER ?= PHPVERSION=$(PHPVERSION) bin/composer

.PHONY: setup
setup: container vendor tests

.PHONY: container
container:
	docker build -t laravel-health-checker:${PHPVERSION} --build-arg PHPVERSION=${PHPVERSION} .docker/

.PHONY: vendor
vendor:
	$(COMPOSER) install

.PHONY: tests
tests:
	$(PHP) vendor/bin/phpunit
