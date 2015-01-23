<?php

namespace DetailTest\Commanding\Options;

class ModuleOptionsTest extends OptionsTestCase
{
    /**
     * @var \Detail\Commanding\Options\ModuleOptions
     */
    protected $options;

    protected function setUp()
    {
        $this->options = $this->getOptions(
            'Detail\Commanding\Options\ModuleOptions',
            array(
                'getCommands',
                'setCommands',
                'getListeners',
                'setListeners',
            )
        );
    }

    public function testCommandsCanBeSet()
    {
        $commands = array(
            array(
                'command' => 'Some/Command/Class',
                'handler' => 'Some/Handler/Class',
            )
        );

        $this->assertTrue(is_array($this->options->getCommands()));
        $this->assertEmpty($this->options->getCommands());

        $this->options->setCommands($commands);

        $this->assertEquals($commands, $this->options->getCommands());
    }

    public function testListenersCanBeSet()
    {
        $listeners = array(
            'Some/Listener/Class',
        );

        $this->assertTrue(is_array($this->options->getListeners()));
        $this->assertEmpty($this->options->getListeners());

        $this->options->setListeners($listeners);

        $this->assertEquals($listeners, $this->options->getListeners());
    }
}
