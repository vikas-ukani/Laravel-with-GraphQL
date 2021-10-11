<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation
1. Clone the repository
```
git clone https://github.com/vikas-ukani/Laravel8-With-GraphQL-APIs.git
```

2. Run composer install to install composer packages.
``` composer i ```

3. Create your .env file by copying the example provided in the repository
```
 cp .env.example .env
```

4. Run `php artisan key:generate` to generate and set an application key to the `.env.` file.

5. Run `php artisan migrate` to run the migrations to the database.

## Running with Docker 🐋

1. Clone the repository
```
git clone https://github.com/vikas-ukani/Laravel8-With-GraphQL-APIs.git
```
2. Build the containers
```
docker-compose up -d
```
3. Create your .env file by copying the example provided in the repository and create a laravel.log file into the container and set permissions
```
 docker-compose exec php-lwg cp .env.example .env
 docker-compose exec php-lwg touch storage/laravel.log   
 docker-compose exec php-lwg chown -R www-data:www-data /var/www/app/storage 
```
4. Finally create a valid artisan key
```
 docker-compose exec php-lwg php artisan key:generate
```
Now you can migrations, seeders or any command with the containers.

## Little About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.
   
## Contributing

Contributions, Developer Discussions, and Any Valuable Feedback are most welcome. [Make your CONTRIBUTING](https://github.com/vikas-ukani/Laravel8-With-GraphQL-APIs/blob/main/CONTRIBUTING.md).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).
