<?php

namespace Detail\Commanding\Listener;

use Psr\Log\LogLevel;

use Zend\EventManager\EventManagerInterface;

//use Detail\Commanding\Command\CommandInterface;
use Detail\Commanding\CommandDispatcherEvent;
use Detail\Log\Listener\BaseLoggingListener;

class LoggingListener extends BaseLoggingListener
{
    public function __construct()
    {
        $this->setLoggerPrefix('Commanding');
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
//        $this->listeners[] = $events->attach(
//            CommandDispatcherEvent::EVENT_PRE_HANDLE, array($this, 'onPreHandle'), $priority
//        );

        $this->listeners[] = $events->attach(
            CommandDispatcherEvent::EVENT_DISPATCH,
            [$this, 'onDispatch'],
            $priority
        );
    }

//    public function onPreDispatch(CommandDispatcherEvent $event)
//    {
//    }

    /**
     * @param CommandDispatcherEvent $event
     */
    public function onDispatch(CommandDispatcherEvent $event)
    {
        $commandName = $event->getParam(CommandDispatcherEvent::PARAM_COMMAND_NAME, 'unknown command');

//        /** @var CommandInterface $command */
//        $command = $e->getParam(CommandDispatcherEvent::PARAM_COMMAND);

        $this->log(sprintf('Command "%s" was dispatched', $commandName), LogLevel::DEBUG);
    }
}
