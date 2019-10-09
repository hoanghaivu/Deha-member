## Requirement

- Php: 7.2
- Mysql: 5.7
- Nginx

## Setup environment development

- Clone project and laradock and build with info requirement

- After build environment, please access to container of workspace and run command below:

	- composer install
	- php artisan migrate --seed
	- npm install
	- npm run prod (If you want min file)
	- npm run dev (If you debug)
	