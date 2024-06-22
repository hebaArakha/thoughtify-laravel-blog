# Thoughtify Blog

This project includes Laravel Breeze for authentication. It also comes with database seeders to help you get started quickly with some sample data.

## Getting started

Getting Started
Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

## Prerequisites

-   Make sure you have the following software installed on your machine:

    -   PHP (recommended version 7.4+)
    -   Composer (latest version)
    -   MySQL or other supported database systems
    -   A server like apache

## Installation

-   clone the repo
    -   git clone git@github.com:hebaArakha/thoughtify-laravel-blog.git
-   Navigate into the project directory
    -   cd thoughtify-laravel-blog
-   Install PHP dependencies
    -   composer install
-   Create a copy of the .env file
    -   cp .env.example .env
-   instal npm packages
    -   npm install 
-   Generate application key
    -   php artisan key:generate
-   Configure the database -- Open .env file and set your database credentials:
    ```DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
- Run database migrations and seeders
  - php artisan migrate --seed
- Running the Development Server
  - php artisan serve
-  npm run dev


## Author
##### https://github.com/hebaArakha






