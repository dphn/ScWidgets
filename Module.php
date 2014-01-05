<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScWidgets;

use ZfcBase\Module\AbstractModule,
    Zend\Mvc\MvcEvent;

if (0 > version_compare(phpversion(), '5.4.0')) {
    exit(
        'The module ScWidgets need PHP version >= 5.4.0'
    );
}

/**
 * Short alias for DIRECTORY_SEPARATOR
 *
 * @const string
 */
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class Module extends AbstractModule
{
    /**
     * @return string
     */
    public function getDir()
    {
        return __DIR__;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
     * @param Zend\Mvc\MvcEvent $event
     * @return void
     */
    public function onBootstrap(MvcEvent $event)
    {
        $app = $event->getApplication();
        $serviceLocator = $app->getServiceManager();

        // Example of using ScContent installation feature
        $installation = $serviceLocator->get('ScWidgets.Options.InstallationOptions')
            ->getInstallation();

        $serviceLocator->get('ScListener.Installation.Inspector')->setup($installation);
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return include __DIR__ . DS . 'config' . DS . 'services.config.php';
    }

    /**
     * @return array
     */
    public function getControllerConfig()
    {
        return include __DIR__ . DS . 'config' . DS . 'controllers.config.php';
    }

    /**
     * @return array
     */
    public function getFormElementConfig()
    {
        return include __DIR__ . DS . 'config' . DS . 'form.elements.config.php';
    }
}
