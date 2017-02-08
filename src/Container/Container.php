<?php

namespace SRC\Container;

use Interop\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;

class Container implements ContainerInterface
{
    protected $container;
    public function __construct(SymfonyContainerInterface $container)
    {
        $this->container = $container;
    }

    public function get($id)
    {
        return $this->container->get($id);
    }

    public function has($id)
    {
        return $this->container->has($id);
    }

    public function set($id, $service)
    {
        $this->container->set($id, $service);
    }
}