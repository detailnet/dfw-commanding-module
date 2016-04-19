<?php

namespace Detail\Commanding;

use Zend\ServiceManager;

use Detail\Commanding\Handler\CommandHandlerInterface;
use Detail\Commanding\Exception;

/**
 * Plugin manager implementation for command handlers.
 *
 * Enforces that handlers retrieved are instances of CommandHandlerInterface.
 */
class CommandHandlerManager extends ServiceManager\AbstractPluginManager
{
    /**
     * Whether or not to share by default
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * {@inheritDoc}
     */
    public function validatePlugin($plugin)
    {
        if (!$plugin instanceof CommandHandlerInterface) {
            throw new Exception\RuntimeException(
                sprintf(
                    'Invalid command handler: Expected instance of %s, got %s',
                    CommandHandlerInterface::CLASS,
                    is_object($plugin) ? get_class($plugin) : gettype($plugin)
                )
            );
        }
    }
}
