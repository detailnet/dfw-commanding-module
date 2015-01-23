<?php

namespace Detail\Commanding\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Commanding\CommandDispatcher;
use Detail\Commanding\Exception;

class CommandDispatcherFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Commanding\Options\ModuleOptions $moduleOptions */
        $moduleOptions = $serviceLocator->get('Detail\Commanding\Options\ModuleOptions');

        /** @var \Detail\Commanding\CommandHandlerManager $commandHandlerManager */
        $commandHandlerManager = $serviceLocator->get('Detail\Commanding\CommandHandlerManager');
        $commandHandlerManager->setServiceLocator($serviceLocator);

        $commandDispatcher = new CommandDispatcher($commandHandlerManager);

        $commands = $moduleOptions->getCommands();

        foreach ($commands as $command) {
            if (!isset($command['command'])) {
                throw new Exception\ConfigException(
                    'Command is missing required configuration option "command"'
                );
            }

            if (!isset($command['handler'])) {
                throw new Exception\ConfigException(
                    'Command is missing required configuration option "handler"'
                );
            }

            $commandDispatcher->register($command['command'], $command['handler']);
        }

        $listeners = $moduleOptions->getListeners();

        foreach ($listeners as $listener) {
            /** @todo Lazy load listeners? */
            $commandDispatcher->getEventManager()->attach(
                $serviceLocator->get($listener)
            );
        }

        return $commandDispatcher;
    }
}
