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
    ScContent\Options\ModuleOptions as ScModuleOptions,
    //
    ScWidgets\Form\BannerForm,
    ScWidgets\Entity\Banner,
    //
    Zend\View\Model\ViewModel;

class BannerWidgetController extends AbstractWidget
{
    /**
     * @var ScContent\Options\ModuleOptions
     */
    protected $scModuleOptions;

    public function frontAction()
    {
        $view = new ViewModel();
        $item = $this->getItem();

        if ($item->findOption('image')) {
            $image = $item->findOption('image');

            $scModuleOptions = $this->getScModuleOptions();

            $theme = $scModuleOptions->getFrontendTheme();
            $themeImages = sprintf(
                '/%s/img', $scModuleOptions->getFrontendThemeName()
            );
            if (isset($theme['images'])) {
                $themeImages = $theme['images'];
            }
            $image = str_replace('{theme_images}', $themeImages, $image);

            $uploadsSrc = $scModuleOptions->getAppUploadsSrc();
            $image = str_replace('{uploads}', $uploadsSrc, $image);

            $view->image = $image;
        }

        return $view;
    }

    public function backAction()
    {
        $item = $this->getItem();
        $entity = new Banner($item);
        $form = new BannerForm();
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

    public function setScModuleOptions(ScModuleOptions $options)
    {
        $this->scModuleOptions = $options;
    }

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
