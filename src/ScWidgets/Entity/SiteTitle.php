<?php

namespace ScWidgets\Entity;

use ScContent\Entity\AbstractEntity,
    ScContent\Entity\WidgetInterface;

class SiteTitle extends AbstractEntity
{
    /**
     * @var ScContent\Entity\WidgetInterface
     */
    protected $widget;

    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    public function setLogo($src)
    {
        $this->widget->setOption('logo', $src);
    }

    public function getLogo()
    {
        return $this->widget->findOption('logo');
    }

    public function setTitle($title)
    {
        //var_dump($title); exit();
        $this->widget->setOption('title', $title);
        //var_dump($this->widget->findOption('title')); exit();
    }

    public function getTitle()
    {
        return $this->widget->findOption('title');
    }
}
