<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScWidgets\Entity;

use ScContent\Entity\AbstractList,
    //
    ScWidgets\Entity\SearchResult;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class SearchResultsList extends AbstractList
{
    /**
     * @var integer
     */
    protected $totalPages = 1;

    /**
     * @param integer $count
     * @return void
     */
    public function setTotalPages($count)
    {
        $count = (int) $count;
        if ($count > 1) {
            $this->totalPages = $count;
        }
    }

    /**
     * @return integer
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @param ScWidgets\Entity\SearchResult $item
     * @return void
     */
    public function addItem(SearchResult $item)
    {
        $this->items[] = $item;
    }
}
