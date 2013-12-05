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
        ],
    ],
];
