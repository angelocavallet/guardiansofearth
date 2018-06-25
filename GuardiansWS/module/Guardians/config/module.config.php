<?php
return [
    'doctrine' => [
        'driver' => [
            'orm' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => '../src/Guardians/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Guardians\\Entity' => 'orm',
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \Guardians\Authentication\Adapter\HeaderAuthentication::class => \Guardians\Factory\AuthenticationAdapterFactory::class,
            \Guardians\Listener\ApiAuthenticationListener::class => \Guardians\Factory\AuthenticationListenerFactory::class,
            \Guardians\V1\Rest\Usuario\UsuarioResource::class => \Guardians\V1\Rest\Usuario\UsuarioResourceFactory::class,
            \Guardians\V1\Rest\Partida\PartidaResource::class => \Guardians\V1\Rest\Partida\PartidaResourceFactory::class,
            \Guardians\V1\Rest\Rodada\RodadaResource::class => \Guardians\V1\Rest\Rodada\RodadaResourceFactory::class,
            \Guardians\V1\Rest\Registro\RegistroResource::class => \Guardians\V1\Rest\Registro\RegistroResourceFactory::class,
            \Guardians\V1\Rest\Carta\CartaResource::class => \Guardians\V1\Rest\Carta\CartaResourceFactory::class,
            \Guardians\V1\Rest\Item\ItemResource::class => \Guardians\V1\Rest\Item\ItemResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'guardians.rest.usuario' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/usuario[/:usuario_id]',
                    'defaults' => [
                        'controller' => 'Guardians\\V1\\Rest\\Usuario\\Controller',
                    ],
                ],
            ],
            'guardians.rest.partida' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/partida[/:partida_id]',
                    'defaults' => [
                        'controller' => 'Guardians\\V1\\Rest\\Partida\\Controller',
                    ],
                ],
            ],
            'guardians.rest.rodada' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/rodada[/:rodada_id]',
                    'defaults' => [
                        'controller' => 'Guardians\\V1\\Rest\\Rodada\\Controller',
                    ],
                ],
            ],
            'guardians.rest.registro' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/registro[/:rodada_id]',
                    'defaults' => [
                        'controller' => 'Guardians\\V1\\Rest\\Registro\\Controller',
                    ],
                ],
            ],
            'guardians.rest.carta' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/carta[/:carta_id]',
                    'defaults' => [
                        'controller' => 'Guardians\\V1\\Rest\\Carta\\Controller',
                    ],
                ],
            ],
            'guardians.rest.item' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/item[/:partida_id]',
                    'defaults' => [
                        'controller' => 'Guardians\\V1\\Rest\\Item\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'guardians.rest.usuario',
            1 => 'guardians.rest.partida',
            2 => 'guardians.rest.rodada',
            3 => 'guardians.rest.registro',
            4 => 'guardians.rest.carta',
            5 => 'guardians.rest.item',
        ],
    ],
    'zf-rest' => [
        'Guardians\\V1\\Rest\\Usuario\\Controller' => [
            'listener' => \Guardians\V1\Rest\Usuario\UsuarioResource::class,
            'route_name' => 'guardians.rest.usuario',
            'route_identifier_name' => 'usuario_id',
            'collection_name' => 'usuario',
            'entity_http_methods' => [
                0 => 'POST',
                1 => 'GET',
                2 => 'PATCH',
                3 => 'DELETE',
                4 => 'PUT',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'PUT',
                2 => 'POST',
                3 => 'PATCH',
                4 => 'DELETE',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Guardians\Entity\Usuario::class,
            'collection_class' => \Guardians\V1\Rest\Usuario\UsuarioCollection::class,
            'service_name' => 'usuario',
        ],
        'Guardians\\V1\\Rest\\Partida\\Controller' => [
            'listener' => \Guardians\V1\Rest\Partida\PartidaResource::class,
            'route_name' => 'guardians.rest.partida',
            'route_identifier_name' => 'partida_id',
            'collection_name' => 'partida',
            'entity_http_methods' => [
                0 => 'POST',
                1 => 'GET',
                2 => 'PATCH',
                3 => 'DELETE',
                4 => 'PUT',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'PUT',
                2 => 'POST',
                3 => 'PATCH',
                4 => 'DELETE',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Guardians\Entity\Partida::class,
            'collection_class' => \Guardians\V1\Rest\Partida\PartidaCollection::class,
            'service_name' => 'partida',
        ],
        'Guardians\\V1\\Rest\\Rodada\\Controller' => [
            'listener' => \Guardians\V1\Rest\Rodada\RodadaResource::class,
            'route_name' => 'guardians.rest.rodada',
            'route_identifier_name' => 'rodada_id',
            'collection_name' => 'rodada',
            'entity_http_methods' => [
                0 => 'PUT',
            ],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [
                0 => 'partida',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Guardians\Entity\Rodada::class,
            'collection_class' => \Guardians\V1\Rest\Rodada\RodadaCollection::class,
            'service_name' => 'rodada',
        ],
        'Guardians\\V1\\Rest\\Registro\\Controller' => [
            'listener' => \Guardians\V1\Rest\Registro\RegistroResource::class,
            'route_name' => 'guardians.rest.registro',
            'route_identifier_name' => 'rodada_id',
            'collection_name' => 'registro',
            'entity_http_methods' => [
                0 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [
                0 => 'rodada',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Guardians\Entity\Registro::class,
            'collection_class' => \Guardians\V1\Rest\Registro\RegistroCollection::class,
            'service_name' => 'registro',
        ],
        'Guardians\\V1\\Rest\\Carta\\Controller' => [
            'listener' => \Guardians\V1\Rest\Carta\CartaResource::class,
            'route_name' => 'guardians.rest.carta',
            'route_identifier_name' => 'carta_id',
            'collection_name' => 'carta',
            'entity_http_methods' => [
                0 => 'GET',
            ],
            'collection_http_methods' => [],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Guardians\Entity\Carta::class,
            'collection_class' => \Guardians\V1\Rest\Carta\CartaCollection::class,
            'service_name' => 'carta',
        ],
        'Guardians\\V1\\Rest\\Item\\Controller' => [
            'listener' => \Guardians\V1\Rest\Item\ItemResource::class,
            'route_name' => 'guardians.rest.item',
            'route_identifier_name' => 'partida_id',
            'collection_name' => 'item',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [
                0 => 'partida',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Guardians\Entity\Item::class,
            'collection_class' => \Guardians\V1\Rest\Item\ItemCollection::class,
            'service_name' => 'item',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Guardians\\V1\\Rest\\Usuario\\Controller' => 'HalJson',
            'Guardians\\V1\\Rest\\Partida\\Controller' => 'HalJson',
            'Guardians\\V1\\Rest\\Rodada\\Controller' => 'HalJson',
            'Guardians\\V1\\Rest\\Registro\\Controller' => 'HalJson',
            'Guardians\\V1\\Rest\\Carta\\Controller' => 'HalJson',
            'Guardians\\V1\\Rest\\Item\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Guardians\\V1\\Rest\\Usuario\\Controller' => [
                0 => 'application/json',
                1 => 'application/vnd.guardians.v1+json',
                2 => 'application/hal+json',
            ],
            'Guardians\\V1\\Rest\\Partida\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Guardians\\V1\\Rest\\Rodada\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Guardians\\V1\\Rest\\Registro\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Guardians\\V1\\Rest\\Carta\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Guardians\\V1\\Rest\\Item\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Guardians\\V1\\Rest\\Usuario\\Controller' => [
                0 => 'application/json',
                1 => 'application/vnd.guardians.v1+json',
            ],
            'Guardians\\V1\\Rest\\Partida\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/json',
            ],
            'Guardians\\V1\\Rest\\Rodada\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/json',
            ],
            'Guardians\\V1\\Rest\\Registro\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/json',
            ],
            'Guardians\\V1\\Rest\\Carta\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/json',
            ],
            'Guardians\\V1\\Rest\\Item\\Controller' => [
                0 => 'application/vnd.guardians.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            'Guardians\\V1\\Rest\\Usuario\\Usuario' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.usuario',
                'route_identifier_name' => 'usuario_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Guardians\V1\Rest\Usuario\UsuarioCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.usuario',
                'route_identifier_name' => 'usuario_id',
                'is_collection' => true,
            ],
            \Guardians\Entity\Usuario::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.usuario',
                'route_identifier_name' => 'usuario_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            'Guardians\\V1\\Rest\\Partida\\Partida' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.partida',
                'route_identifier_name' => 'partida_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Guardians\V1\Rest\Partida\PartidaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.partida',
                'route_identifier_name' => 'partida_id',
                'is_collection' => true,
            ],
            \Guardians\Entity\Partida::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.partida',
                'route_identifier_name' => 'partida_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            'Guardians\\V1\\Rest\\Rodada\\Rodada' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.rodada',
                'route_identifier_name' => 'rodada_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Guardians\V1\Rest\Rodada\RodadaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.rodada',
                'route_identifier_name' => 'rodada_id',
                'is_collection' => true,
            ],
            \Guardians\Entity\Rodada::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.rodada',
                'route_identifier_name' => 'rodada_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            'Guardians\\V1\\Rest\\Registro\\RegistroEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.registro',
                'route_identifier_name' => 'registro_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Guardians\V1\Rest\Registro\RegistroCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.registro',
                'route_identifier_name' => 'registro_id',
                'is_collection' => true,
            ],
            'Guardians\\V1\\Rest\\Carta\\CartaEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.carta',
                'route_identifier_name' => 'carta_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Guardians\V1\Rest\Carta\CartaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.carta',
                'route_identifier_name' => 'carta_id',
                'is_collection' => true,
            ],
            \Guardians\Entity\Carta::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.carta',
                'route_identifier_name' => 'carta_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Guardians\Entity\Registro::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.registro',
                'route_identifier_name' => 'rodada_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            'Guardians\\V1\\Rest\\Item\\ItemEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.item',
                'route_identifier_name' => 'item_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Guardians\V1\Rest\Item\ItemCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.item',
                'route_identifier_name' => 'item_id',
                'is_collection' => true,
            ],
            \Guardians\Entity\Item::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'guardians.rest.item',
                'route_identifier_name' => 'partida_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'Guardians\\V1\\Rest\\Usuario\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
            'Guardians\\V1\\Rest\\Partida\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
    'zf-content-validation' => [
        'Guardians\\V1\\Rest\\Usuario\\Controller' => [
            'input_filter' => 'Guardians\\V1\\Rest\\Usuario\\Validator',
        ],
        'Guardians\\V1\\Rest\\Partida\\Controller' => [
            'input_filter' => 'Guardians\\V1\\Rest\\Partida\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Guardians\\V1\\Rest\\Usuario\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'nome',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'senha',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'email',
            ],
        ],
        'Guardians\\V1\\Rest\\Partida\\Validator' => [],
    ],
];
