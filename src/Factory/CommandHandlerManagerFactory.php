<?php

namespace Detail\Commanding\Factory;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use Detail\Commanding\CommandHandlerManager;
use Detail\Commanding\Options\ModuleOptions;

class CommandHandlerManagerFactory implements
    FactoryInterface
{
    /**
     * Create CommandHandlerManager
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return CommandHandlerManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var ModuleOptions $moduleOptions */
        $moduleOptions = $container->get(ModuleOptions::CLASS);

        return new CommandHandlerManager($container, $moduleOptions->getCommandHandlerManager());
    }
}
