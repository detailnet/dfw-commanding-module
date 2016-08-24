<?php

return array(
    'service_manager' => array(
        'abstract_factories' => array(
        ),
        'aliases' => array(
        ),
        'invokables' => array(
        ),
        'factories' => array(
            'Detail\Commanding\Listener\LoggingListener' => 'Detail\Commanding\Factory\Listener\LoggingListenerFactory',
            'Detail\Commanding\CommandDispatcher' => 'Detail\Commanding\Factory\CommandDispatcherFactory',
            'Detail\Commanding\CommandHandlerManager' => 'Detail\Commanding\Factory\CommandHandlerManagerFactory',
            'Detail\Commanding\Options\ModuleOptions' => 'Detail\Commanding\Factory\Options\ModuleOptionsFactory',
        ),
        'initializers' => array(
            'Detail\Commanding\Service\CommandDispatcherInitializer',
        ),
        'shared' => array(
        ),
    ),
    'controllers' => array(
        'initializers' => array(
            'Detail\Commanding\Service\CommandDispatcherInitializer',
        ),
    ),
    'detail_commanding' => array(
        'command_handler_manager' => array(
            'initializers' => array(
                'Detail\Commanding\Service\CommandDispatcherInitializer',
            ),
        ),
        'commands' => array(
        ),
        'listeners' => array(
        ),
    ),
);
