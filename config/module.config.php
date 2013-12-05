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
            'login' => [
                'options' => [
                    'display_name' => 'Example',
                    'description' => 'Example widget.',
                ],
                'frontend' => [
                    'controller' => 'ScWidgets.Controller.Example',
                    'action' => 'front',
                ],
            ],
            'test_1' => [
                'options' => [
                    'display_name' => 'Test 1',
                    'description' => 'The first widget for testing.',
                ],
            ],
            'test_2' => [
                'options' => [
                    'display_name' => 'Test 2',
                    'description' => 'The second widget for testing.',
                ],
            ],
            'test_3' => [
                'options' => [
                    'display_name' => 'Test 3',
                    'description' => 'The third widget for testing.',
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'ScWidgets' => __DIR__ . '/../view',
        ],
    ],
];
