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

    public function testModuleProvidesConfig()
    {
        $config = $this->module->getConfig();

        $this->assertTrue(is_array($config));
        $this->assertArrayHasKey('detail_commanding', $config);
        $this->assertTrue(is_array($config['detail_commanding']));
    }
}
