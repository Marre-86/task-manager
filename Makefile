go:
	php artisan serve
PORT ?= 6985
railway: generate start
start:
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT)  -t public
generate:
	php artisan key:generate
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
