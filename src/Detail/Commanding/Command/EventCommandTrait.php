<?php

namespace Detail\Commanding\Command;

use Zend\EventManager\EventManager;
//use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

trait EventCommandTrait
{
    /**
     * @var EventManagerInterface
     */
    protected $events;

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
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(
            array(
                get_class($this),
            )
        );

        $this->events = $events;
    }
}
