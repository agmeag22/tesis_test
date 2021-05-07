<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel-Starter
Laravel-Starter is a base project with:
- Larevel UI Authentication (User and Role),
- Middleware to check if user is and admin or not.
- Migrations for Users and Roles.
- Krlove to generate Models from database tables.

## Requirements

- PHP 7.2
- MySQL 5.7
- Node JS 14.16.0

## Instalation

- Create .env file
```bash
cp .env.example .env
```
- Modify .env file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=database_port
DB_DATABASE=database_name
DB_USERNAME=database_user
DB_PASSWORD=database_password
```

- Install all composer dependencies
```bash
composer install
```

- Install all npm dependencies
```bash
npm install
```

- Generate all the database tables
```bash
php artisan migrate
```

- Generate app key
```bash
php artisan key:generate
```


