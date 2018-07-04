<?php

namespace Detail\Commanding;

use Zend\ServiceManager\AbstractPluginManager;

use Detail\Commanding\Handler\CommandHandlerInterface;
use Detail\Commanding\Exception;

class CommandHandlerManager extends AbstractPluginManager
{
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
