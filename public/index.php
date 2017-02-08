<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

define('APPDIR', __DIR__ . '/../');

use \SRC\Container\ContainerBuilder as ContainerBuilder;

$container = (new ContainerBuilder(realpath(__DIR__.'/../')))
    ->getContainer();

$app = $container->get('common.app');
$doc = $container->get('doc');

// Register routes
require_once APPDIR.'/routes.php';

// Run!
$app->run();


