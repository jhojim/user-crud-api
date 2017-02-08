# Users & Roles CRUD for Slim framework

	User & roles CRUD for PHP micro-framework Slim with Aut0 autentification 

#### Directories structure
```
	path/to/project
	|-- public
	|   |-- doc
	|   |-- docinternal
	|-- src
	|   |-- Actions
	|   |-- Common
	|   |-- Container
	|   |-- Exeption
	|   |-- Middleware
	|   |-- Service
	|-- tests
	`-- vendor
	```
	Requirements
	---

	* PHP 5.5+
	* [Composer][compoer]

## Installation

	clone git repo

	then console composer install

## Configuration

	Make your changes to config in "path/to/project/container.conf.php"

	``` php

	$container->setParameter('database', [
	    'dbname' => 'your_db',
	    'user' => 'your_db_user',
	    'password' => 'your_db_user_password',
	    'host' => '127.0.0.1',
	    'driver' => 'pdo_mysql'
	]);

	$container->setParameter('auth0', [
	    'client_id' => 'your_client_id',
	    'client_secret' => 'your_client_secret',
	    'domain' => 'your_domain.auth0.com',
	    'scope' => 'openid email email_verified app_metadata iss sub aud exp iat',
	    'connection' => 'Username-Password-Authentication'
	]);

	$container->setParameter('jwt.secret', 'your_jwt_secret');

	```

## Usage

	#### Run PHP built-in server
	Run a built-in server on 0.0.0.0:8888
	```shell
	$ php -S 0.0.0.0:8888 -t public public/index.php
	```

	Open web browser with address http://localhost:8888


## Tests

	phpunit --debug

## Documentation 

	php generatedoc.php 

[composer]:  https://getcomposer.org
[doc-dbal]:  https://github.com/doctrine/dbal
[phpunit]:   https://phpunit.de/
[slim-fw]:   http://slimframework.com/