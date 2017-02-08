<?php

require_once 'vendor/autoload.php';

$pathToSrc = __DIR__.'/src';

use \SRC\Container\WrapperContainerBuilder as ContainerBuilder;

$container = (new ContainerBuilder(realpath(__DIR__.'/')))
    ->getContainer();

$doc = $container->get('doc');

$doc->generate($pathToSrc, $argc, $argv);
