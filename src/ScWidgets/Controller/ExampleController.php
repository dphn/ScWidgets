<?php

namespace ScWidgets\Controller;

use ScContent\Controller\WidgetFrontInterface,
    //
    Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class ExampleController extends AbstractActionController implements
    WidgetFrontInterface
{
    public function frontAction()
    {
        return new ViewModel();
    }
}
