<?php

namespace Detail\Commanding\Service;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Initializer\InitializerInterface;

use Detail\Commanding\CommandDispatcher;

class CommandDispatcherInitializer implements
    InitializerInterface
{
    /**
     * Initialize the given instance
     *
     * @param ContainerInterface $container
     * @param object $instance
     * @return void
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if ($instance instanceof CommandDispatcherAwareInterface) {
            /** @var CommandDispatcher $commandDispatcher */
            $commandDispatcher = $container->get(CommandDispatcher::CLASS);

            $instance->setCommands($commandDispatcher);
        }
    }
}
