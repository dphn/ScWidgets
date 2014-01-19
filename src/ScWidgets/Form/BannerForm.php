<?php

namespace ScWidgets\Form;

use Zend\Form\Form;

class BannerForm extends Form
{
    public function __construct()
    {
        parent::__construct('banner');

        $this->setAttribute('method', 'post')
            ->setFormSpecification()
            ->setInputSpecification();
    }

    protected function setFormSpecification()
    {
        $this->add([
            'name' => 'image',
            'type' => 'text',
            'options' => [
                'label' => 'Image source',
            ],
            'attributes' => [
                'placeholder' => 'Image src',
                'required' => 'required',
                'class' => 'form-control',
                'id' => 'image',
            ],
        ]);

        $this->add([
            'name' => 'save',
            'type' => 'button',
            'options' => [
                'label' => 'Save',
            ],
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-primary',
                'value' => 'save',
            ],
        ]);

        return $this;
    }

    protected function setInputSpecification()
    {
        $spec = $this->getInputFilter();

        $spec->add([
            'name' => 'logo',
            'required' => false,
            'filters' => [
                [
                    'name' => 'StringTrim',
                ],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'max' => 255,
                        'encoding' => 'utf-8',
                    ],
                ],
            ],
        ]);

        return $this;
    }
}
