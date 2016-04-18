<?php
return [
    'api_adapters' => [
        'invokables' => [
            'custom_vocabs' => 'CustomVocab\Api\Adapter\CustomVocabAdapter',
        ],
    ],
    'entity_manager' => [
        'mapping_classes_paths' => [
            OMEKA_PATH . '/modules/CustomVocab/src/Entity',
        ],
    ],
    'data_types' => [
        'abstract_factories' => ['CustomVocab\Service\CustomVocabFactory'],
    ],
    'view_manager' => [
        'template_path_stack'      => [
            OMEKA_PATH . '/modules/CustomVocab/view',
        ],
    ],
    'controllers' => [
        'invokables' => [
            'CustomVocab\Controller\Index' => 'CustomVocab\Controller\IndexController',
        ],
    ],
    'navigation' => [
        'admin' => [
            [
                'label' => 'Custom Vocab',
                'route' => 'admin/custom-vocab',
                'resource' => 'CustomVocab\Controller\Index',
                'privilege' => 'browse',
                'pages' => [
                    [
                        'route' => 'admin/custom-vocab/add',
                        'visible' => false,
                    ],
                    [
                        'route' => 'admin/custom-vocab/id',
                        'visible' => false,
                    ],
                ],
            ],
        ],
    ],
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'custom-vocab' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/custom-vocab',
                            'defaults' => [
                                '__NAMESPACE__' => 'CustomVocab\Controller',
                                'controller' => 'Index',
                                'action' => 'browse',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'add' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/add',
                                    'defaults' => [
                                        'action' => 'add',
                                    ],
                                ],
                            ],
                            'id' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/:id[/:action]',
                                    'constraints' => [
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'id' => '\d+',
                                    ],
                                    'defaults' => [
                                        'action' => 'show',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
