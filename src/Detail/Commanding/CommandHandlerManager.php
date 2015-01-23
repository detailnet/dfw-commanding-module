<?php

namespace Detail\Commanding;

use Zend\ServiceManager\AbstractPluginManager;

use Detail\Commanding\Handler\CommandHandlerInterface;
use Detail\Commanding\Exception;

/**
 * Plugin manager implementation for command handlers.
 *
 * Enforces that handlers retrieved are instances of CommandHandlerInterface.
 */
class CommandHandlerManager extends AbstractPluginManager
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
        if ($plugin instanceof CommandHandlerInterface) {
            // We're okay
            return;
        }

        throw new Exception\RuntimeException(
            sprintf(
                'Plugin of type %s is invalid; must implement %s\CommandHandlerInterface',
                (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
                __NAMESPACE__
            )
        );
    }
}
