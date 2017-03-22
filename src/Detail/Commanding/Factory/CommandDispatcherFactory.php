<?php

namespace Detail\Commanding\Factory;

use Interop\Container\ContainerInterface;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Detail\Commanding\CommandDispatcher;
use Detail\Commanding\CommandHandlerManager;
use Detail\Commanding\Exception;
use Detail\Commanding\Options\ModuleOptions;

class CommandDispatcherFactory implements FactoryInterface
{
    /**
     * Create CommandDispatcher
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return CommandDispatcher
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var ModuleOptions $moduleOptions */
        $moduleOptions = $container->get(ModuleOptions::CLASS);

        /** @var CommandHandlerManager $commandHandlerManager */
        $commandHandlerManager = $container->get(CommandHandlerManager::CLASS);
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

        foreach ($listeners as $listenerName) {
            /** @todo Lazy load listeners? */
            /** @var ListenerAggregateInterface $listener */
            $listener = $container->get($listenerName);
            $listener->attach($commandDispatcher->getEventManager());
        }

        return $commandDispatcher;
    }
}
