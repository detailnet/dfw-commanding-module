<?php

namespace Detail\Commanding\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Commanding\CommandHandlerManager;
use Detail\Commanding\Options\ModuleOptions;

class CommandHandlerManagerFactory implements
    FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return CommandHandlerManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ModuleOptions $moduleOptions */
        $moduleOptions = $serviceLocator->get(ModuleOptions::CLASS);

        return new CommandHandlerManager($serviceLocator, $moduleOptions->getCommandHandlerManager());
    }
}
