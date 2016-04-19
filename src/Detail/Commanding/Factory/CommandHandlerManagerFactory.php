<?php

namespace Detail\Commanding\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Commanding\CommandHandlerManager;
use Detail\Commanding\Exception;
use Detail\Commanding\Service\CommandDispatcherInitializer;

class CommandHandlerManagerFactory implements
    FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $manager = new CommandHandlerManager($serviceLocator);
        $manager->addInitializer(new CommandDispatcherInitializer());

        return $manager;
    }
}
