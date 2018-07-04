<?php

namespace Detail\Commanding;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements
    ConfigProviderInterface
{
    /**
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
