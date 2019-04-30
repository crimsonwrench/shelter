# Shelter
A reddit-like imageboard.

# Requirements
 - PHP >= 7.1.3
 - Composer
 - PDO PHP Extension + pdo_mysql
 - Docker + docker-compose
 - NPM
 - Vue-cli

# Installation
**IMPORTANT:** please make sure that your 192.168.1.0/29 network and 8080-8081 ports are not occupied by running applications.

### Clone git repository
```
git clone https://github.com/crimsonwrench/shelter.git
```
### Install backend dependencies
```
cd shelter/backend/src && composer install
```
### Deploy containers
```
docker-compose up -d
```
### Copy .env.example file to .env
```
cp .env.example .env
```
### Generate App Key
```
php artisan key:generate
```
### Migrate and seed database
```
php artisan migrate && php artisan db:seed
```
### Generate Laravel Passport keys and copy password grant client ID and secret to .env file
```
php artisan passport:install
```
Example output:
> Password grant client created successfully.\
> Client ID: `2`\
> Client secret: `6IAw8faXHGaLxhfWaAqUWQEj1iK6oMsDgyzwiyR0`

.env file:
> PASSPORT_CLIENT_ID=`2`\
> PASSPORT_CLIENT_SECRET=`6IAw8faXHGaLxhfWaAqUWQEj1iK6oMsDgyzwiyR0`

### Install frontend dependencies
```
cd ../../frontend && npm i
```

### Run frontend server
```
npm run serve
```
Site will then be available at localhost:8080

# Development/Production
By default, frontend is configured for development.\
If you want to build it for production, comment `proxy_...` lines with `#` and uncomment `try_files` line in `location / { ... }` route in `shelter/frontend/config/shelter.conf`\
Your route should be as following:
```
location / {
    #proxy_pass http://192.168.0.102:8081; # npm server address
    #proxy_http_version 1.1;
    #proxy_set_header Upgrade $http_upgrade;
    #proxy_set_header Connection "Upgrade";
    try_files $uri $uri/ /index.html;
}
```
### Build and restart docker container
```
docker-compose down && docker-compose build && docker compose up -d
```
### Build frontend
```
npm run build
```
### Disable APP_DEBUG in `shelter/backend/src/.env` to prevent exposure of debug data
```
APP_DEBUG=false
```