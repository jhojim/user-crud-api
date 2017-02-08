<?php

$app->get('/', function() {
    echo 'hi';
});

$app->post('/auth', 'action.auth');

$app->group('/{sitename}', function() use ($app) {
    $app->get('/roles', 'action.roles');
    $app->put('/roles/{id}', 'action.roles');
    $app->post('/roles', 'action.roles');
    $app->delete('/roles/{id}', 'action.roles');

    $app->get('/users', 'action.users');
    $app->put('/users', 'action.users');
    $app->post('/users', 'action.users');
    $app->delete('/users', 'action.users');
})->add('middleware.VerifyUser')->add('middleware.jwt');

$app->get('/user', 'action.user')->add('middleware.VerifyUser')->add('middleware.jwt');
$app->get('/role/{id}', 'action.role')->add('middleware.VerifyUser')->add('middleware.jwt');