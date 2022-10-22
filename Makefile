.PHONY: help

#!make
include .env

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sed 's/Makefile://' | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install:
	composer install
	yarn
	php bin/console doctrine:database:create
	make reset

migrate:
	php bin/console make:migration
	php bin/console doctrine:migrations:migrate --no-interaction

reset:
	php bin/console doctrine:migrations:migrate --no-interaction
	php bin/console doctrine:fixtures:load --no-interaction

cs:
	vendor/bin/php-cs-fixer fix

stan:
	vendor/bin/phpstan --memory-limit=4G

start:
	symfony server:stop
	symfony server:start -d
	symfony open:local
	yarn watch