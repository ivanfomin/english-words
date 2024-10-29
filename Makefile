init: docker-down-clear docker-pull docker-build-pull docker-up
down: docker-down-clear


docker-up:
	docker compose up -d

docker-down-clear:
	docker compose down  --remove-orphans

docker-down-volumes:
	docker compose down -v --remove-orphans

docker-pull:
	docker compose pull

docker-build-pull:
	docker compose build --pull

composer-install:
	docker compose run --rm php-fpm composer init
composer-autoload:
	docker compose run --rm php-fpm composer dump-autoload
compose-tests:
	docker compose run --rm php-fpm composer test

lint:
	docker-compose run --rm php-fpm composer php-cs-fixer fix -- --dry-run --diff
cs-fix:
	docker-compose run --rm php-fpm composer php-cs-fixer fix

app-init: composer-install