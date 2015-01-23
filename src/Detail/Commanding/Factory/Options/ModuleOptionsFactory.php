<?php

namespace Detail\Commanding\Factory\Options;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Commanding\Exception\ConfigException;
use Detail\Commanding\Options\ModuleOptions;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        if (!isset($config['detail_normalization'])) {
            throw new ConfigException('Config for Detail\Commanding is not set');
        }

        return new ModuleOptions($config['detail_commanding']);
    }
}
