# Portfolio API - Laravel Docker Setup

This project runs Laravel inside Docker using Nginx, PHP-FPM, and MySQL.  
Use this setup for local development of your portfolio API with clean architecture.


## 🐳 Docker Setup

### 1. Start Docker Containers

docker compose up -d --build

### 2. Stop Docker Containers
docker compose down

###3 Access Laravel container
docker exec -it laravel-app bash

 ### 4 Inside container: install dependencies
composer install
php artisan key:generate
php artisan migrate

## 5 MySQL data is stored in Docker volume mysql_data.

docker compose down -v

### 
composer create-project laravel/laravel . "10.*"


chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache


php artisan module:make Profile

### Command create modules
mkdir -p app/Modules/Profile/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers}

php artisan make:migration create_profiles_table

composer dump-autoload

mkdir -p app/Modules/User/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers}

mkdir -p app/Modules/Education/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers}
mkdir -p app/Modules/Experience/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers}
mkdir -p app/Modules/Project/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers}
mkdir -p app/Modules/Contact/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers}

php artisan make:seeder UserSeeder

php artisan db:seed

php artisan migrate:fresh --seed

php artisan db:seed --class=EducationSeeder

docker-compose down
docker-compose build app
docker-compose up -d

php -i | grep memory_limit

docker restart nginx

php artisan system:reset-cache