test:
	php artisan test
test-coverage:
	composer phpunit tests -- --coverage-clover build/logs/clover.xml
install:
	composer install
run:
	php artisan serve
lint:
	composer run-script phpcs
lint-fix:
	composer run-script phpcbf
setup: install
	cp -n .env.example .env || true
	php artisan key:generate
	touch database/database.sqlite
	php artisan migrate
npm:
	npm install && npm run dev
seed:
	php artisan db:seed
clear:
	php artisan route:clear
	php artisan view:clear
	php artisan cache:clear
	php artisan config:clear
