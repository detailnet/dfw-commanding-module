<?php

namespace Detail\Commanding\Factory\Listener;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use Detail\Commanding\Listener\LoggingListener;

class LoggingListenerFactory implements
    FactoryInterface
{
    /**
     * Create an object
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return LoggingListener
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $listener = new LoggingListener();

        return $listener;
    }
}
