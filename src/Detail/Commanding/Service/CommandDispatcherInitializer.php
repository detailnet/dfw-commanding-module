<?php

namespace Detail\Commanding\Commanding\Service;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

use Detail\Commanding\Service\CommandDispatcherAwareInterface;

class CommandDispatcherInitializer implements
    InitializerInterface
{
    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof CommandDispatcherAwareInterface) {
            if ($serviceLocator instanceof ServiceLocatorAwareInterface) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }

            /** @var \Detail\Commanding\CommandDispatcher $commandDispatcher */
            $commandDispatcher = $serviceLocator->get('Detail\Commanding\CommandDispatcher');

            $instance->setCommands($commandDispatcher);
        }
    }
}
