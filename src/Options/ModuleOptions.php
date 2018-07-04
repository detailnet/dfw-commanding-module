<?php

namespace Detail\Commanding\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var array
     */
    protected $commandHandlerManager = [];

    /**
     * @var array
     */
    protected $commands = [];

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * @return array
     */
    public function getCommandHandlerManager()
    {
        return $this->commandHandlerManager;
    }

    /**
     * @param array $commandHandlerManager
     */
    public function setCommandHandlerManager(array $commandHandlerManager)
    {
        $this->commandHandlerManager = $commandHandlerManager;
    }

    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param array $commands
     */
    public function setCommands(array $commands)
    {
        $this->commands = $commands;
    }

    /**
     * @return array
     */
    public function getListeners()
    {
        return $this->listeners;
    }

    /**
     * @param array $listeners
     */
    public function setListeners(array $listeners)
    {
        $this->listeners = $listeners;
    }
}
