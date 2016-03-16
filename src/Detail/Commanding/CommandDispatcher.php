<?php

namespace Detail\Commanding;

use ArrayObject;

use Zend\EventManager\EventManager;
//use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

use Detail\Commanding\Command\CommandInterface;
use Detail\Commanding\Handler\CommandHandlerInterface;
use Detail\Commanding\Exception;

class CommandDispatcher implements
    CommandDispatcherInterface
{
    /**
     * @var CommandHandlerManager
     */
    protected $commandHandlers;

    /**
     * @var EventManagerInterface
     */
    protected $events;

    /**
     * @var array
     */
    protected $eventParams = array();

    /**
     * @param CommandHandlerManager $commandHandlers
     */
    public function __construct(CommandHandlerManager $commandHandlers)
    {
        $this->commandHandlers = $commandHandlers;
    }

    /**
     * Retrieve the event manager instance.
     *
     * Lazy-initializes one if none present.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (!$this->events) {
            $this->setEventManager(new EventManager());
        }

        return $this->events;
    }

    /**
     * Set the event manager instance.
     *
     * @param EventManagerInterface $events
     * @return self
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(
            array(
                __CLASS__,
                get_class($this),
                __NAMESPACE__ . '\CommandDispatcherInterface'
            )
        );

        $this->events = $events;
        return $this;
    }

    /**
     * @param array $params
     * @return self
     */
    public function setEventParams(array $params)
    {
        $this->eventParams = $params;
        return $this;
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return $this->eventParams;
    }

    /**
     * @param string $commandName
     * @param CommandHandlerInterface|string $commandHandler
     * @return void
     */
    public function register($commandName, $commandHandler)
    {
        if ($commandHandler instanceof CommandHandlerInterface) {
            $this->commandHandlers->setService($commandName, $commandHandler);
        } else {
            $this->commandHandlers->setFactory($commandName, $commandHandler);
        }
    }

    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function dispatch(CommandInterface $command)
    {
        $commandName = $this->getCommandName($command);

        if (!$this->commandHandlers->has($commandName)) {
            throw new Exception\RuntimeException(
                sprintf('No handler registered for command "%s"', $commandName)
            );
        }

        $preEventParams = array(
            CommandDispatcherEvent::PARAM_COMMAND_NAME => $commandName,
            CommandDispatcherEvent::PARAM_COMMAND => $command,
        );

        $continueDispatch = $this->triggerPreDispatchEvent(CommandDispatcherEvent::EVENT_PRE_DISPATCH, $preEventParams);

        /** @todo Remove when we can break backwards compatibility */
        if ($continueDispatch) {
            $continueDispatch = $this->triggerPreDispatchEvent(CommandDispatcherEvent::EVENT_PRE_HANDLE, $preEventParams);
        }

        if (!$continueDispatch) {
            /** @todo Should probably trigger an abort event */
            return null;
        }

        $commandHandler = $this->commandHandlers->get($commandName);
        $commandHandlerResult = $commandHandler->handle($command);

        $postEventParams = array_merge(
            $preEventParams,
            array(
                CommandDispatcherEvent::PARAM_RESULT => $commandHandlerResult
            )
        );

        $this->triggerPostDispatchEvent(CommandDispatcherEvent::EVENT_DISPATCH, $postEventParams);
        /** @todo Remove when we can break backwards compatibility */
        $this->triggerPostDispatchEvent(CommandDispatcherEvent::EVENT_HANDLE, $postEventParams);

        return $commandHandlerResult;
    }

    /**
     * @param CommandInterface $command
     * @return mixed
     * @deprecated Use dispatch()
     */
    public function handle(CommandInterface $command)
    {
        return $this->dispatch($command);
    }

    /**
     * @param CommandInterface $command
     * @return string
     */
    protected function getCommandName(CommandInterface $command)
    {
        $className = get_class($command);

        return $className;

//        $classNameParts = explode('\\', $className);
//
//        return $classNameParts[count($classNameParts) - 1];
    }

    /**
     * @param string $name
     * @param array $params
     * @return boolean
     */
    protected function triggerPreDispatchEvent($name, array $params = array())
    {
        $preEvent = $this->prepareEvent($name, $params);
        $results = $this->getEventManager()->trigger($preEvent, function ($result) {
            // Don't dispatch the command when a listener returns false
            return ($result === false);
        });

        return $results->last() !== false;
    }

    /**
     * @param string $name
     * @param array $params
     */
    protected function triggerPostDispatchEvent($name, array $params = array())
    {
        $postEvent = $this->prepareEvent($name, $params);
        $this->getEventManager()->trigger($postEvent);
    }

    /**
     * @param string $name
     * @param array $params
     * @return CommandDispatcherEvent
     */
    protected function prepareEvent($name, array $params)
    {
        $event = new CommandDispatcherEvent($name, $this, $this->prepareEventParams($params));
//        $event->setQueryParams($this->getQueryParams());

        return $event;
    }

    /**
     * Prepare event parameters.
     *
     * Ensures event parameters are created as an array object, allowing them to be modified
     * by listeners and retrieved.
     *
     * @param  array $params
     * @return ArrayObject
     */
    protected function prepareEventParams(array $params)
    {
        $defaultParams = $this->getEventParams();
        $params = array_merge($defaultParams, $params);

        if (empty($params)) {
            return $params;
        }

        return $this->getEventManager()->prepareArgs($params);
    }
}
