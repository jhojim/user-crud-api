<?php

$container->setParameter('database', [
    'dbname' => 'sample_db',
    'user' => 'sample_db_user',
    'password' => 'sample_db_user_password',
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
