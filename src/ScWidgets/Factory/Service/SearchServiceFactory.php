<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScWidgets\Factory\Service;

use ScWidgets\Service\SearchService,
    //
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\FactoryInterface;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class SearchServiceFactory implements FactoryInterface
{
    /**
     * @param Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return ScWidgets\Service\SearchService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('ScWidgets.Mapper.SearchMapper');
        $service = new SearchService();
        $service->setMapper($mapper);
        return $service;
    }
}
