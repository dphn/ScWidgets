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
            'site_title' => [
                'display_name' => 'Site title',
                'description' => 'Logo and site title.',
                'options' => [
                    'unique' => true,
                    'logo'  => '/{theme_images}/brand.png',
                    'title'  => 'ScContent - ZF2 based CMS',
                ],
                'frontend' => 'ScWidgets.Controller.SiteTitle',
                'backend'  => 'ScWidgets.Controller.SiteTitle',
            ],
            'search' => [
                'display_name' => 'Search',
                'description' => 'A search form.',
                'options' => [
                ],
                'frontend' => 'ScWidgets.Controller.Search',
            ],
            'banner' => [
                'display_name' => 'Banner',
                'description' => 'Banner with a static image.',
                'options' => [
                    'image' => '/{theme_images}/banners/banner0.png',
                ],
                'frontend' => 'ScWidgets.Controller.Banner',
                'backend'  => 'ScWidgets.Controller.Banner',
            ],
            'example' => [
                'display_name' => 'Example',
                'description' => 'Example widget.',
                'options' => [
                ],
                'frontend' => 'ScWidgets.Controller.Example',
            ],
            'login' => [
                'display_name' => 'Login',
                'description' => 'Login widget.',
                'options' => [
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
