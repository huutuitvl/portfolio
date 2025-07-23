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

### Command create modules
php artisan make:migration create_profiles_table
composer dump-autoload
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

mkdir -p app/Modules/User/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}
mkdir -p app/Modules/Education/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}
mkdir -p app/Modules/Experience/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}
mkdir -p app/Modules/Project/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}
mkdir -p app/Modules/Contact/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}
mkdir -p app/Modules/Profile/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}
mkdir -p app/Modules/Blog/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}
mkdir -p app/Modules/Skill/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}
mkdir -p app/Modules/Certificate/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}
mkdir -p app/Modules/Contact/{Domain/Entities,Application/Services,Infrastructure/Repositories,Interface/Http/Controllers,Interface/Http/Requests,Interface/Http/Resources,Providers,Database/Migrations,Database/Seeders}

php artisan make:migration create_blogs_table
php artisan db:seed --class=BlogSeeder
php artisan db:seed --class=ExperienceSeeder
php artisan db:seed --class=SkillSeeder
php artisan db:seed --class=CertificateSeeder
php artisan db:seed --class=ProfileSeeder
php artisan db:seed --class=ContactSeeder

php artisan migrate --path=src/database/migrations/2025_07_15_163747_create_experiences_table.php
php artisan migrate:rollback  --path=src/database/migrations/2025_07_15_163747_create_experiences_table.php --step=1

php artisan migrate --path=src/database/migrations/2025_07_19_064547_create_certificate_table.php
php artisan migrate:rollback  --path=src/database/migrations/2025_07_19_064547_create_certificate_table.php --step=1


php artisan make:migration create_certificate_table
php artisan make:migration create_contacts_table
