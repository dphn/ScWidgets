<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScWidgets\Service;

use ScWidgets\Options\SearchOptions,
    ScWidgets\Mapper\SearchMapper,
    //
    ScContent\Exception\IoCException;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class SearchService
{
    /**
     * @var ScWidgets\Options\SearchOptions
     */
    protected $options;

    /**
     * @var ScWidgets\Mapper\SearchMapper
     */
    protected $mapper;

    /**
     * @param ScWidgets\Options\SearchOptions $options
     * @return void
     */
    public function setOptions(SearchOptions $options)
    {
        $this->options = $options;
    }

    /**
     * @return ScWidgets\Options\SearchOptions
     */
    public function getOptions()
    {
        if (! $this->options instanceof SearchOptions) {
            $this->options = new SearchOptions();
        }
        return $this->options;
    }

    /**
     * @param SearchMapper $mapper
     * @return void
     */
    public function setMapper(SearchMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @throws ScContent\Exception\IoCException
     * @return ScWidgets\Mapper\SearchMapper
     */
    public function getMapper()
    {
        if (! $this->mapper instanceof SearchMapper) {
            throw new IoCException(
                'The search mapper was not set.'
            );
        }
        return $this->mapper;
    }

    /**
     * @param ScWidgets\Options\SearchOptions $options
     * @return ScWidgets\Entity\SearchResultsList
     */
    public function getResultsList($options)
    {
        $mapper = $this->getMapper();
        $list = $mapper->find($options);
        return $list;
    }
}
