<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScWidgets\Options;

use ScContent\Entity\AbstractEntity,
    ScContent\Exception\DomainException;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class SearchOptions extends AbstractEntity
{
    /**
     * @var string
     */
    protected $needle = '';

    /**
     * @var string
     */
    protected $filter = 'all';

    /**
     * @var string
     */
    protected $order = 'newest';

    /**
     * @var integer
     */
    protected $page = 1;

    /**
     * @var integer
     */
    protected $limit = 10;

    /**
     * @var array
     */
    protected static $filters = ['all', 'categories', 'articles', 'files'];

    /**
     * @var array
     */
    protected static $orders = ['newest', 'oldest', 'alphabetical'];

    /**
     * @param string $needle
     * @return void
     */
    public function setNeedle($needle)
    {
        $this->needle = $needle;
    }

    /**
     * @return string
     */
    public function getNeedle()
    {
        return $this->needle;
    }

    /**
     * @param string $filter
     */
    public function setFilter($filter)
    {
        if (! in_array($filter, static::$filters, true)) {
            throw new DomainException(sprintf(
                "Unknown filter '%s'.",
                $filter
            ));
        }
        $this->filter = $filter;
    }

    /**
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        if (! in_array($order, static::$orders, true)) {
            throw new DomainException(sprintf(
                "Unknown order '%s'.",
                $order
            ));
        }
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param integer $page
     */
    public function setPage($page)
    {
        $page = (int) $page;
        if ($page > 0) {
            $this->page = $page;
        }
    }

    /**
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param integer $limit
     */
    public function setLimit($limit)
    {
        // not used in this version
    }

    /**
     * @return integer
     */
    public function getLimit()
    {
        return $this->limit;
    }
}
