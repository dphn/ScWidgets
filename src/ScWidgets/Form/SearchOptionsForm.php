<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScWidgets\Form;

use Zend\Validator\InArray,
    Zend\Form\Form;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class SearchOptionsForm extends Form
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('search');
        $this->setAttribute('method', 'get')
            ->setUseInputFilterDefaults(false)
            ->setFormSpecification()
            ->setInputSpecification();
    }

    /**
     * @return ScWidgets\Form\SearchOptionsForm
     */
    protected function setFormSpecification()
    {
        $this->add([
            'name' => 'needle',
            'type' => 'text',
            'options' => [
                'label' => 'Keywords',
            ],
            'attributes' => [
                'maxlength' => 64,
                'class' => 'form-control',
                'id' => 'search-keywords',
            ],
        ]);

        $this->add([
            'name' => 'filter',
            'type' => 'radio',
            'options' => [
                'label' => 'Filter',
                'value_options' => [
                    'all'        => 'All',
                    'categories' => 'Categories',
                    'articles'   => 'Articles',
                    'files'      => 'Files',
                ],
            ],
            'attributes' => [
                'value' => 'all',
            ],
        ]);

        $this->add([
            'name' => 'order',
            'type' => 'select',
            'options' => [
                'label' => 'Search order',
                'value_options' => [
                    'newest'       => 'Newest first',
                    'oldest'       => 'Oldest first',
                    'alphabetical' => 'Alphabetically',
                ],
            ],
            'attributes' => [
                'value' => 'newest',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'page',
            'type' => 'text',
            'attributes' => [
                'class' => 'form-control input-sm',
            ],
        ]);

        return $this;
    }

    /**
     * @return ScWidgets\Form\SearchOptionsForm
     */
    protected function setInputSpecification()
    {
        $spec = $this->getInputFilter();

        $spec->add([
            'name' => 'needle',
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
                        'encoding' => 'utf-8',
                        'min' => 3,
                        'max' => 64,
                    ],
                ],
            ],
        ]);

        $spec->add([
            'name' => 'order',
            'required' => false,
            'validators' => [
                [
                    'name' => 'inArray',
                    'options' => [
                        'haystack' => ['newest', 'oldest', 'alphabetical'],
                        'strict'   => InArray::COMPARE_STRICT,
                        'messages' => [
                            InArray::NOT_IN_ARRAY => "Unknown search order '%value%'.",
                        ],
                    ],
                ],
            ],
        ]);

        $spec->add([
            'name' => 'filter',
            'required' => false,
            'validators' => [
                [
                    'name' => 'inArray',
                    'options' => [
                        'haystack' => ['all', 'categories', 'articles', 'files'],
                        'strict'   => InArray::COMPARE_STRICT,
                        'messages' => [
                            InArray::NOT_IN_ARRAY => "Unknown search filter '%value%'.",
                        ],
                    ],
                ],
            ],
        ]);

        $spec->add([
            'name' => 'page',
            'required' => false,
        ]);

        return $this;
    }
}
