<?php

namespace DetailTest\Commanding;

use PHPUnit\Framework\TestCase;

use Zend\Loader\StandardAutoloader;

use Detail\Commanding\Module;

class ModuleTest extends TestCase
{
    /**
     * @var Module
     */
    protected $module;

    protected function setUp()
    {
        $this->module = new Module();
    }

    public function testModuleProvidesAutoloaderConfig()
    {
        $config = $this->module->getAutoloaderConfig();

        $this->assertTrue(is_array($config));

        $autoloaderClass = StandardAutoloader::CLASS;

        $this->assertArrayHasKey($autoloaderClass, $config);
        $this->assertArrayHasKey('namespaces', $config[$autoloaderClass]);
        $this->assertArrayHasKey('Detail\Commanding', $config[$autoloaderClass]['namespaces']);
    }

    public function testModuleProvidesConfig()
    {
        $config = $this->module->getConfig();

        $this->assertTrue(is_array($config));
        $this->assertArrayHasKey('detail_commanding', $config);
        $this->assertTrue(is_array($config['detail_commanding']));
    }

    public function testModuleProvidesControllerConfig()
    {
        $config = $this->module->getControllerConfig();

        $this->assertTrue(is_array($config));
    }

    public function testModuleProvidesServiceConfig()
    {
        $config = $this->module->getServiceConfig();

        $this->assertTrue(is_array($config));
    }
}
