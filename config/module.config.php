<?php

return array(
    'service_manager' => array(
        'abstract_factories' => array(
        ),
        'aliases' => array(
        ),
        'invokables' => array(
            'Detail\Commanding\CommandHandlerManager' => 'Detail\Commanding\CommandHandlerManager',
        ),
        'factories' => array(
            'Detail\Commanding\Listener\LoggingListener' => 'Detail\Commanding\Factory\Listener\LoggingListenerFactory',
            'Detail\Commanding\CommandDispatcher'        => 'Detail\Commanding\Factory\CommandDispatcherFactory',
            'Detail\Commanding\Options\ModuleOptions'    => 'Detail\Commanding\Factory\Options\ModuleOptionsFactory',
        ),
        'initializers' => array(
            'Detail\Commanding\Service\CommandDispatcherInitializer',
        ),
        'shared' => array(
        ),
    ),
    'detail_commanding' => array(
    ),
);
