up:
	./vendor/bin/sail up -d && npm run dev

down:
	./vendor/bin/sail down

migrate:
	./vendor/bin/sail artisan migrate

fresh:
	./vendor/bin/sail artisan migrate:fresh

seed:
	./vendor/bin/sail artisan db:seed

route-cache:
	./vendor/bin/sail artisan route:cache

route-list:
	./vendor/bin/sail artisan route:list

tinker:
	./vendor/bin/sail artisan tinker
