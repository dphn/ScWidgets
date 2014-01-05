<?php

namespace ScWidgets\Controller;

use ScContent\Controller\AbstractFront,
    ScWidgets\Service\SearchService,
    //
    Zend\View\Model\ViewModel;

class FrontendSearchController extends AbstractFront
{
    protected $service;

    protected $form;

    public function indexAction()
    {
        if (! $this->params()->fromQuery('needle')) {
            return $this->redirect()->toRoute('home')->setStatusCode(303);
        }
        $view = new ViewModel();
        $view->setTemplate('sc-widgets/frontend-search/index');
        $service = $this->getService();

        $searchOptions = $service->getOptions();
        $view->options = $searchOptions;

        $params = $this->params()->fromQuery();

        $form = $this->getForm();
        $view->form = $form;

        $form->bind($searchOptions)
             ->setData($params)
             ->isValid();

        $list = $service->getResultsList($searchOptions);
        $view->list = $list;
        return $view;
    }

    public function setService(SearchService $service)
    {
        $this->service = $service;
    }

    public function getService()
    {
        if (! $this->service instanceof SearchService) {
            $serviceLocator = $this->getServiceLocator();
            $this->service = $serviceLocator->get(
                'ScWidgets.Service.SearchService'
            );
        }
        return $this->service;
    }

    public function setForm(SearchForm $form)
    {
        $this->form = $form;
    }

    public function getForm()
    {
        if (! $this->form instanceof SearchOptionsForm) {
            $serviceLocator = $this->getServiceLocator();
            $formElementManager = $serviceLocator->get(
                'FormElementManager'
            );
            $this->form = $formElementManager->get(
                'ScWidgets.Form.SearchOptionsForm'
            );
        }
        return $this->form;
    }
}
