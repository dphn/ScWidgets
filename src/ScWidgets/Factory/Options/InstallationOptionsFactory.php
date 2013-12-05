<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScWidgets\Factory\Options;

use ScWidgets\Options\InstallationOptions,
    ScWidgets\Module,
    //
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\FactoryInterface;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class InstallationOptionsFactory implements FactoryInterface
{
    /**
     * @param Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return ScWidgets\Options\InstallationOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $baseDir = Module::getDir();
        $options = include(
            $baseDir . DS . 'config' . DS . 'installation.config.php'
        );
        $installationOptions = new InstallationOptions($options);
        return $installationOptions;
    }
}
