<?php

use Detail\Commanding;
use Detail\Commanding\Factory;

return [
    'service_manager' => [
        'abstract_factories' => [],
        'aliases' => [],
        'invokables' => [],
        'factories' => [
            Commanding\Listener\LoggingListener::CLASS => Factory\Listener\LoggingListenerFactory::CLASS,
            Commanding\CommandDispatcher::CLASS => Factory\CommandDispatcherFactory::CLASS,
            Commanding\CommandHandlerManager::CLASS => Factory\CommandHandlerManagerFactory::CLASS,
            Commanding\Options\ModuleOptions::CLASS => Factory\Options\ModuleOptionsFactory::CLASS,
        ],
        'initializers' => [
            Commanding\Service\CommandDispatcherInitializer::CLASS,
        ],
        'shared' => [],
    ],
    'controllers' => [
        'initializers' => [
            Commanding\Service\CommandDispatcherInitializer::CLASS,
        ],
    ],
    'detail_commanding' => [
        'command_handler_manager' => [
            'initializers' => [
                Commanding\Service\CommandDispatcherInitializer::CLASS,
            ],
        ],
        'commands' => [],
        'listeners' => [],
    ],
];
