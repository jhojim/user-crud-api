<?php

namespace SRC\Container;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class WrapperContainerBuilder
{
    protected $dependencies =  [];
    protected $dependenciesPaths = [];
    protected $currentDirectory;

    public function __construct($currentDirectory)
    {
        $this->currentDirectory = $currentDirectory;
    }

    public function getContainer()
    {
        $container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
        $this->registerDependencies();
        $this->loadDependencies($container);

        $container->compile();

        $dumper = new PhpDumper($container);
        file_put_contents('cache.php', $dumper->dump());

        include_once 'cache.php';

        $container = new \ProjectServiceContainer();


        return $container;
    }

    protected function registerDependencies()
    {
        // add current directory to dependencies
        if (is_file($this->currentDirectory . '/container.php')) {
            $this->dependenciesPaths[] = $this->currentDirectory . '/container.php';
        }
        if (is_file($this->currentDirectory . '/container.conf.php')) {
            $this->dependenciesPaths[] = $this->currentDirectory . '/container.conf.php';
        }
    }

    protected function loadDependencies($container)
    {
        $loader = new PhpFileLoader($container, new FileLocator($this->currentDirectory));
        foreach ($this->dependenciesPaths as $dependency) {
            $loader->load($dependency);
        }
    }
}