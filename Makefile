go:
	php artisan serve
railway: migrate start
PORT ?= 6985
start:
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT)  -t public
mifrate:
	php artisan migrate --force
install:
	composer install
validate:
	composer validate
generateKey:
	php artisan key:generate --env=testing
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app public routes tests --ignore=public/css,public/build/assets
test:
	php artisan test --coverage --min=80
tests: generateKey test
