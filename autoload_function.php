<?php
/**
 * ScWidgets (https://github.com/dphn/ScContent)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return function($class) {
    static $map;
    if (! $map) {
        $map = include __DIR__ . '/autoload_classmap.php';
    }

    if (! isset($map[$class])) {
        return false;
    }
    return include $map[$class];
};
