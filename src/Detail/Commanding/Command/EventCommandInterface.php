<?php

namespace Detail\Commanding\Command;

use Zend\EventManager\EventManagerInterface;

interface EventCommandInterface
{
    /**
     * Retrieve the event manager instance.
     *
     * Lazy-initializes one if none present.
     *
     * @return EventManagerInterface
     */
    public function getEventManager();

    /**
     * Set the event manager instance.
     *
     * @param EventManagerInterface $events
     */
    public function setEventManager(EventManagerInterface $events);
}
