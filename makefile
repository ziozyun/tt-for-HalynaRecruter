up:
	docker-compose up -d

down:
	docker-compose down

install:
	docker-compose exec app composer install

key:
	docker-compose exec app php artisan key:generate

migrate:
	docker-compose exec app php artisan migrate

seed:
	docker-compose exec app php artisan db:seed

perm:
	sudo chmod -R 777 src/storage src/bootstrap/cache

bash:
	docker-compose exec app bash

logs:
	docker-compose logs -f
