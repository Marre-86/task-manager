PORT ?= 8000
start:
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT)  -t public
install:
	composer install
validate:
	composer validate
generateKey:
	php artisan key:generate --env=testing
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app public routes tests --ignore=public/css,public/build/assets
test:
	composer exec --verbose phpunit tests
tests: generateKey test
test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml
