<?php

namespace ScWidgets\Entity;

use ScContent\Entity\AbstractEntity,
    ScContent\Entity\WidgetInterface;

class Banner extends AbstractEntity
{
    /**
     * @var ScContent\Entity\WidgetInterface
     */
    protected $widget;

    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    public function setImage($src)
    {
        $this->widget->setOption('image', $src);
        return $this;
    }

    public function getImage()
    {
        return $this->widget->findOption('image');
    }
}
