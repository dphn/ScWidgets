<?php

namespace ScWidgets\Controller;

use ScContent\Controller\AbstractWidget,
    ScContent\Options\ModuleOptions as ScModuleOptions,
    //
    ScWidgets\Entity\SiteTitle,
    ScWidgets\Form\SiteTitleForm,
    //
    Zend\View\Model\ViewModel;

class SiteTitleWidgetController extends AbstractWidget
{
    /**
     * @var ScContent\Options\ModuleOptions
     */
    protected $scModuleOptions;

    public function frontAction()
    {
        $item = $this->getItem();

        $options = $item->getOptions(false);

        if (isset($options['logo'])) {
            $logo = $options['logo'];

            $scModuleOptions = $this->getScModuleOptions();

            $theme = $scModuleOptions->getFrontendTheme();
            $themeImages = sprintf(
                '/%s/img', $scModuleOptions->getFrontendThemeName()
            );
            if (isset($theme['images'])) {
                $themeImages = $theme['images'];
            }
            $logo = str_replace('{theme_images}', $themeImages, $logo);

            $uploadsSrc = $scModuleOptions->getAppUploadsSrc();
            $logo = str_replace('{uploads}', $uploadsSrc, $logo);

            $options['logo'] = $logo;
        }

        return new ViewModel($options);
    }

    public function backAction()
    {
        $item = $this->getItem();
        $entity = new SiteTitle($item);
        $form = new SiteTitleForm();
        $form->setAttribute(
            'action',
            $this->url()->fromRoute(
                'sc-admin/widget/edit', ['id' => $item->getId()]
            )
        );

        $form->bind($entity);

        if($this->getRequest()->isPost()) {
            // Parameters of the widget will be saved automatically.
            $form->setData($this->request->getPost()) && $form->isValid();
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * @param ScContent\Options\ModuleOptions $options
     * @return void
     */
    public function setScModuleOptions(ScModuleOptions $options)
    {
        $this->scModuleOptions = $options;
    }

    /**
     * @return ScContent\Options\ModuleOptions
     */
    public function getScModuleOptions()
    {
        if (! $this->scModuleOptions instanceof ScModuleOptions) {
            $serviceLocator = $this->getServiceLocator();
            $this->scModuleOptions = $serviceLocator->get(
                'ScOptions.ModuleOptions'
            );
        }
        return $this->scModuleOptions;
    }
}
