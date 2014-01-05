<?php

return [
    /* Why these 'sc' options here? Why not 'config/autoload'?
     *
     * If the module is disabled, these options will not be present in the
     * global configuration. It is important, because uses
     * both the database and configuration.
     * Take this into consideration when writing a "widget module".
     */
    'sc' => [
        'widgets' => [
            'search' => [
                'options' => [
                    'display_name' => 'Search',
                    'description' => 'A search form.',
                ],
                'frontend' => 'ScWidgets.Controller.SearchWidget',
            ],
            'example' => [
                'options' => [
                    'display_name' => 'Example',
                    'description' => 'Example widget.',
                ],
                'frontend' => 'ScWidgets.Controller.Example',
            ],
            'login' => [
                'options' => [
                    'display_name' => 'Login',
                    'description' => 'Login widget.',
                ],
                'frontend' => 'ScWidgets.Controller.Login',
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'ScWidgets' => __DIR__ . '/../view',
        ],
    ],
    'router' => [
        'routes' => [
            'search' => [
                'type' => 'literal',
                'priority' => 1000,
                'options' => [
                    'route' => '/search',
                    'defaults' => [
                        'controller' => 'ScWidgets.Controller.FrontendSearch',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
];
