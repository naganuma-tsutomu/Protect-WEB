include .env

up:
	docker compose up -d
stop:
	docker compose stop
down:
	docker compose down
restart:
	@make down
	@make up
wp:
	docker exec -it $(TITLE)-wp /bin/bash
ps:
	docker compose ps
logs:
	docker compose logs
phpmyadmin:
	docker compose --profile debug up -d phpmyadmin
npm:
	npm i