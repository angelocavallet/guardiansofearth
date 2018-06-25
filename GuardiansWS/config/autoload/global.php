<?php
return [
    'zf-content-negotiation' => [
        'selectors' => [],
    ],
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => '',
                    'dbname' => 'guardians',
                ],
            ],
        ],
        'entitymanager' => [
            'orm_default' => [
                'connection' => 'orm_default',
                'configuration' => 'orm_default',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authentication' => [
            'map' => [
                'Guardians\\V1' => 'http',
            ],
        ],
    ],
];
