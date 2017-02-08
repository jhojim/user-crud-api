<?php

use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;

$container->setParameter('settings', [
    'httpVersion' => '1.1',
    'responseChunkSize' => 4096,
    'outputBuffering' => 'append',
    'determineRouteBeforeAppMiddleware' => false,
    'displayErrorDetails' => true,
]);

$container->register('container', null)->setSynthetic(true);

$container->register('common.middleware.contentType', \SRC\Middleware\ContentType::class);

$container->register('common.middleware.errorHandler', \SRC\Middleware\ErrorHandler::class);

$container->setAlias('errorHandler', 'common.middleware.errorHandler');

$container->register('settings', \Slim\Collection::class)
    ->setArguments(['%settings%']);

$container->register('common.app', \Slim\App::class)
    ->setArguments([new Reference('container')])
    ->addMethodCall('add', [new Reference('common.middleware.contentType')]);

$container->register('environment', \SRC\Common\Environment::class);

$container->register('request', \Slim\Http\Request::class)
    ->setFactory([\Slim\Http\Request::class, 'createFromEnvironment'])
    ->setArguments([new Reference('environment')]);

$container->register('response', \Slim\Http\Response::class)
    ->setArguments([200, new Reference('headers')])
    ->addMethodCall('withProtocolVersion', ['1.1']);

$container->register('headers', \Slim\Http\Headers::class)
    ->setArguments([['Content-Type' => 'text/html; charset=UTF-8']]);

$container->register('router', \Slim\Router::class);

$container->register('foundHandler', \Slim\Handlers\Strategies\RequestResponse::class);

$container->register('notFoundHandler', \Slim\Handlers\NotFound::class);

$container->register('notAllowedHandler', \Slim\Handlers\NotAllowed::class);

$container->register('callableResolver', \Slim\CallableResolver::class)
    ->setArguments([new Reference('container')]);

$container->register('middleware.jwt', \Slim\Middleware\JwtAuthentication::class)
    ->setFactory([
        new Reference('jwtAuthenticationFactory'),
        'createJwtAuthentication'
    ]);

$container->register('JwtAuthenticationFactory', \SRC\JwtAuthenticationFactory::class)
    ->setArguments(['%jwt.secret%']);

$container->register('middleware.VerifyUser', \SRC\Middleware\VerifyUser::class)
    ->setArguments([
        new Reference('currentUser')
    ]);

$container->setParameter('jwt.secret', '');

$container->register('database', \Doctrine\DBAL\Connection::class)
    ->setFactory([\Doctrine\DBAL\DriverManager::class, 'getConnection'])
    ->setArguments(['%database%']);

$container->register('action.auth', \SRC\Action\Auth::class)->setArguments([
    new Reference('service.auth')
]);

$container->register('auth0', \SRC\Auth0::class)
    ->setArguments([
        '%auth0%'
    ]);

$container->register('service.auth', \SRC\Service\Auth::class)
    ->setArguments([
        '%auth0%'
    ]);

$container->register('usersStorage', \SRC\UsersStorage::class)
    ->setArguments([
        new Reference('database')
    ]);

$container->register('rolesStorage', \SRC\RolesStorage::class)
    ->setArguments([
        new Reference('database')
    ]);

$container->register('action.users', \SRC\Action\Users::class)->setArguments([
    new Reference('service.users'),
    new Reference('auth0'),
    new Reference('currentUser')
]);

$container->register('action.user', \SRC\Action\User::class)->setArguments([
    new Reference('service.users'),
    new Reference('currentUser')
]);

$container->register('action.roles', \SRC\Action\Roles::class)->setArguments([
    new Reference('service.roles'),
    new Reference('currentUser')
]);

$container->register('action.role', \SRC\Action\Role::class)->setArguments([
    new Reference('service.roles')
]);

$container->register('service.roles', \SRC\Service\Roles::class)->setArguments([
    new Reference('rolesStorage'),
    new Reference('usersStorage'),
    new Reference('currentUser')
]);

$container->register('service.users', \SRC\Service\Users::class)->setArguments([
    new Reference('usersStorage'),
    new Reference('rolesStorage'),
    new Reference('currentUser')
]);

$container->register('currentUser', \SRC\CurrentUser::class)->setArguments([
    new Reference('usersStorage')
]);

$container->register('doc', \SRC\Common\Doc::class)
    ->setArguments(['%doc.levels%', '%doc.include%', '%doc.exclude%']);

$container->setParameter('doc.levels', [
    'apikey' => 'public/doc',
    'internal' => 'public/docinternal'
]);

$container->setParameter('doc.include', [
    "/^src/"
]);

$container->setParameter('doc.exclude', [
    'doc/',
    'docinternal/',
    'vendor/'
]);

