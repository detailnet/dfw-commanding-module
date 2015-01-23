<?php

namespace Application\Core\Commanding\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Commanding\CommandDispatcher;

class CommandDispatcherFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Commanding\CommandHandlerManager $commandHandlerManager */
        $commandHandlerManager = $serviceLocator->get('Detail\Commanding\CommandHandlerManager');
        $commandHandlerManager->setServiceLocator($serviceLocator);

        $commandDispatcher = new CommandDispatcher($commandHandlerManager);

        return $commandDispatcher;
    }
}
