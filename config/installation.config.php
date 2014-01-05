<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return [
    'installation' => [
        'layout'   => 'sc-default/layout/installation/index',
        'template' => 'sc-default/template/installation/index',
        'title'    => 'ScWidgets - Installation',
        'header'   => 'Installing a module ScWidgets',
        'redirect_on_success' => 'sc-admin/content-manager',
        'steps' => [
            '1' => [
                'title' => 'Widgets installation',
                'info' => 'Register widgets for the current theme and existing content.',
                'chain' => [
                    'layout' => [
                        'validator' => 'ScValidator.Installation.Layout',
                        'service' => 'ScService.Installation.Layout',
                    ],
                ],
            ],
            '2' => [
                'title' => 'Setting permissions.',
                'info' => 'Set permissions for a module ScContent.',
                'chain' => [
                    'guard' => [
                        'validator' => 'ScValidator.Installation.Autoload',
                        'service'   => 'ScService.Installation.Autoload',
                        'batch' => [
                            'source_module' => 'ScWidgets',
                            'source_file' => '/data/installation/bjyauthorize.scw.v-0.1.0.001.local.php.dist',
                            'old_files_mask' => 'bjyauthorize.scw.v-*',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
