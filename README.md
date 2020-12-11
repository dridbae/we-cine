# Requirements

Symfony 5.2 <br>
PHP 8.0
Node 14 / NPM / Yarn

## Installation

```
git clone git@github.com:dridbae/we-cine.git

Add your TheMovieDbApi key in .env

Use PHP built-in server 

composer install
yarn encore production
php -S 0.0.0.0:8888 -t public/
./vendor/bin/simple-phpunit

or 

Use docker

docker-compose up

docker-compose exec php vendor/bin/simple-phpunit
```

## Usage

```
Go to http://0.0.0.0:8888
```
