<?php

namespace Detail\Commanding\Event;

use Zend\EventManager\Event as BaseEvent;

use Detail\Commanding\Handler\CommandHandlerInterface;

class CommandHandlerEvent extends BaseEvent
{
    /**
     * @return CommandHandlerInterface
     */
    public function getCommandHandler()
    {
        return $this->getTarget();
    }
}
