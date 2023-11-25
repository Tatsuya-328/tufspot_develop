up:
	docker compose up -d
down:
	docker compose down
build:
	docker compose build
app:
	docker compose exec app bash
fresh:
	docker compose exec app php /var/www/html/tufspot/artisan migrate:fresh --seed
tinker:
	docker compose exec app php /var/www/html/tufspot/artisan tinker
cron:
	docker compose exec app service cron start
route:
	docker compose exec app php /var/www/html/tufspot/artisan route:list
