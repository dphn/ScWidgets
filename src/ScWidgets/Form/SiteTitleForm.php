<?php

namespace ScWidgets\Form;

use Zend\Form\Form;

class SiteTitleForm extends Form
{
    public function __construct()
    {
        parent::__construct('site_title');

        $this->setAttribute('method', 'post')
            ->setFormSpecification()
            ->setInputSpecification();
    }

    protected function setFormSpecification()
    {
        $this->add([
            'name' => 'logo',
            'type' => 'text',
            'options' => [
                'label' => 'Logo source',
            ],
            'attributes' => [
                'placeholder' => 'Logo',
                'class' => 'form-control',
                'id' => 'logo',
            ],
        ]);

        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Site title',
            ],
            'attributes' => [
                'placeholder' => 'Title',
                'required' => 'required',
                'class' => 'form-control',
                'id' => 'title',
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

        $spec->add([
            'name' => 'title',
            'required' => true,
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
