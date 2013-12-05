<?php

namespace ScWidgets\Options;

use Zend\Stdlib\AbstractOptions;

class InstallationOptions extends AbstractOptions
{
    /**
     * @var array
     */
    protected $installation = [];

    /**
     * @param array $options
     * @return void
     */
    public function setInstallation($options)
    {
        $this->installation = $options;
    }

    /**
     * @return array
     */
    public function getInstallation()
    {
        return $this->installation;
    }
}