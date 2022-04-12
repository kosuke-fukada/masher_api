up:
	docker compose up -d
build:
	docker compose build --no-cache --force-rm
laravel-install:
	docker compose exec app composer create-project --prefer-dist laravel/laravel .
init:
	docker compose up -d --build
	docker compose exec app composer install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
remake:
	@make destroy
	@make init
stop:
	docker compose stop
down:
	docker compose down --remove-orphans
restart:
	@make down
	@make up
destroy:
	docker compose down --rmi all --volumes --remove-orphans
migrate:
	docker compose exec app php artisan migrate
fresh:
	docker compose exec app php artisan migrate:fresh --seed
seed:
	docker compose exec app php artisan db:seed
