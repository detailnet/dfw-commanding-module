<?php

namespace DetailTest\Commanding\Options;

use Detail\Commanding\Options\ModuleOptions;

class ModuleOptionsTest extends OptionsTestCase
{
    /**
     * @var ModuleOptions
     */
    protected $options;

    protected function setUp()
    {
        $this->options = $this->getOptions(
            ModuleOptions::CLASS,
            [
                'getCommands',
                'setCommands',
                'getListeners',
                'setListeners',
            ]
        );
    }

    public function testCommandsCanBeSet(): void
    {
        $commands = [
            [
                'command' => 'Some/Command/Class',
                'handler' => 'Some/Handler/Class',
            ],
        ];

        $this->assertTrue(is_array($this->options->getCommands()));
        $this->assertEmpty($this->options->getCommands());

        $this->options->setCommands($commands);

        $this->assertEquals($commands, $this->options->getCommands());
    }

    public function testListenersCanBeSet(): void
    {
        $listeners = [
            'Some/Listener/Class',
        ];

        $this->assertTrue(is_array($this->options->getListeners()));
        $this->assertEmpty($this->options->getListeners());

        $this->options->setListeners($listeners);

        $this->assertEquals($listeners, $this->options->getListeners());
    }
}
