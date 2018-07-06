<?php

namespace Detail\Commanding;

use Zend\ServiceManager\AbstractPluginManager;

use Detail\Commanding\Handler\CommandHandlerInterface;
use Detail\Commanding\Exception;

class CommandHandlerManager extends AbstractPluginManager
{
    /**
     * Validate an instance
     *
     * @param object $instance
     * @return void
     */
    public function validate($instance)
    {
        if (!$instance instanceof CommandHandlerInterface) {
            throw new Exception\RuntimeException(
                sprintf(
                    'Invalid command handler: Expected instance of %s, got %s',
                    CommandHandlerInterface::CLASS,
                    is_object($instance) ? get_class($instance) : gettype($instance)
                )
            );
        }
    }
}
