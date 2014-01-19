<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScWidgets\Controller;

use ScContent\Controller\AbstractWidget,
    ScContent\Exception\DomainException,
    //
    Zend\View\Model\ViewModel;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class SearchWidgetController extends AbstractWidget
{
    /**
     * @return Zend\View\Model\ViewModel
     */
    public function frontAction()
    {
        return new ViewModel();
    }

    /**
     * @throw ScContent\Exception\DomainException
     */
    public function backAction()
    {
        throw new DomainException(
            'Not used.'
        );
    }
}
