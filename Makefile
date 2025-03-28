
SAIL = vendor/bin/sail
DOCKER_IMAGE = laravelsail/php84-composer:latest


.PHONY: install keygen up down stop migrate migrate-fresh npm-build npm-dev npm-install composer-install swagger-gen

install:
	docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        $(DOCKER_IMAGE) \
        composer install --ignore-platform-reqs

keygen:
	$(SAIL) artisan key:generate

up:
	$(SAIL) up -d

stop:
	$(SAIL) stop

down:
	$(SAIL) down

migrate:
	$(SAIL) artisan migrate

migrate-fresh:
	$(SAIL) artisan migrate:fresh

npm-dev:
	$(SAIL) npm run dev

npm-build:
	$(SAIL) npm run build

npm-install:
	$(SAIL) npm install

composer-install:
	$(SAIL) composer install

swagger-gen:
	$(SAIL) artisan l5-swagger:generate
