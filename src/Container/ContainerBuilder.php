<?php

namespace SRC\Container;

class ContainerBuilder extends WrapperContainerBuilder
{
    public function getContainer()
    {
        $symfonyContainer = parent::getContainer();
        $container = new Container($symfonyContainer);
        $container->set('container', $container);

        return $container;
    }
}