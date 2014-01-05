<?php
/**
 * ScWidgets (https://github.com/dphn/ScWidgets)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013 ScContent
 * @link      https://github.com/dphn/ScWidgets
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScWidgets\Mapper;

use ScContent\Mapper\AbstractDbMapper,
    ScWidgets\Options\SearchOptions,
    ScWidgets\Entity\SearchResultsList,
    ScWidgets\Entity\SearchResult,
    //
    Zend\Filter\FilterInterface,
    Zend\Db\Adapter\AdapterInterface,
    Zend\Db\Sql\Predicate\Predicate,
    Zend\Db\Sql\Expression;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class SearchMapper extends AbstractDbMapper
{
    /**
     * @const string
     */
    const ContentTableAlias = 'contentalias';

    /**
     * @const string
     */
    const SearchTableAlias = 'searchalias';

    /**
     * @var array
     */
    protected $_tables = [
        self::ContentTableAlias => 'sc_content',
        self::SearchTableAlias  => 'sc_search',
    ];

    /**
     * @var Zend\Filter\FilterInterface
     */
    protected $morfologyFilter;

    /**
     * @param Zend\Db\Adapter\AdapterInterface $adapter
     * @param Zend\Filter\FilterInterface $filter
     */
    public function __construct(AdapterInterface $adapter, FilterInterface $filter)
    {
        $this->setAdapter($adapter);
        $this->morfologyFilter = $filter;
    }

    /**
     * @param ScWidgets\Options\SearchOptions $options
     * @return ScWidgets\Entity\SearchResultsList
     */
    public function find(SearchOptions $options)
    {
        $list = new SearchResultsList();
        if (! $options->getNeedle()) {
            return $list;
        }
        $total = $this->getCount($list, $options);
        $totalPages = max(1, ceil($total / $options->getLimit()));
        $currentPage = max(1, min($totalPages, $options->getPage()));

        $list->setTotalPages($totalPages);

        if ($currentPage != $options->getPage()) {
            $options->setPage($currentPage);
        }
        $list = $this->findResults($list, $options);
        return $list;
    }

    /**
     * @param ScWidgets\Entity\SearchResultsList
     * @param ScWidgets\Options\SearchOptions $options
     * @return integer
     */
    protected function getCount(SearchResultsList $list, SearchOptions $options)
    {
        $needle = $this->quoteValue(
            $this->morfologyFilter->filter($options->getNeedle())
        );
        $on = new Predicate();
        $select = $this->getSql()->select()
            ->columns([
                'total' => new Expression('COUNT(`content`.`id`)'),
            ])
            ->from([
                'content' => $this->getTable(self::ContentTableAlias)
            ])
            ->join(
                ['search' => $this->getTable(self::SearchTableAlias)],
                $on->literal(
                    "MATCH(`search`.`title`, `search`.`content`, `search`.`description`) AGAINST({$needle} IN BOOLEAN MODE) > '0'"
                ),
                []
            )
            ->where([
                '`content`.`id` = `search`.`id`',
                'content.status' => 'published',
                'content.trash'  => 0,
            ]);

        switch ($options->getOrder()) {
            case 'alphabetical':
                $select->order('content.title ASC');
                break;
            case 'oldest':
                $select->order('content.created DESC');
                break;
            case 'newest':
            default:
                $select->order('content.created ASC');
                break;
        }

        switch ($options->getFilter()) {
            case 'files':
                $select->where(['content.type' => 'file']);
                break;
            case 'articles':
                $select->where(['content.type' => 'article']);
                break;
            case 'categories':
                $select->where(['content.type' => 'category']);
                break;
            case 'all':
            default:
                break;
        }

        $result = $this->execute($select)->current();
        return $result['total'];
    }

    /**
     * @param ScWidgets\Entity\SearchResultsList
     * @param ScWidgets\Options\SearchOptions $options
     * @return ScWidgets\Entity\SearchResultsList
     */
    protected function findResults(SearchResultsList $list, SearchOptions $options)
    {
        $needle = $this->quoteValue(
            $this->morfologyFilter->filter($options->getNeedle())
        );
        $on = new Predicate();
        $select = $this->getSql()->select()
            ->columns([
                'name', 'title', 'content', 'description'
            ])
            ->from([
                'content' => $this->getTable(self::ContentTableAlias)
            ])
            ->join(
                ['search' => $this->getTable(self::SearchTableAlias)],
                $on->literal(
                    "MATCH(`search`.`title`, `search`.`content`, `search`.`description`) AGAINST({$needle} IN BOOLEAN MODE) > '0'"
                ),
                []
            )
            ->where([
                '`content`.`id` = `search`.`id`',
                'content.status' => 'published',
                'content.trash'  => 0,
            ])
            ->limit($options->getLimit())
            ->offset(($options->getPage() - 1) * $options->getLimit());

        switch ($options->getOrder()) {
            case 'alphabetical':
                $select->order('content.title ASC');
                break;
            case 'oldest':
                $select->order('content.created DESC');
                break;
            case 'newest':
            default:
                $select->order('content.created ASC');
                break;
        }

        switch ($options->getFilter()) {
            case 'files':
                $select->where(['content.type' => 'file']);
                break;
            case 'articles':
                $select->where(['content.type' => 'article']);
                break;
            case 'categories':
                $select->where(['content.type' => 'category']);
                break;
            case 'all':
            default:
                break;
        }

        $results = $this->execute($select);
        $hydrator = $this->getHydrator();
        $searchResultPrototype = new SearchResult();

        foreach ($results as $result) {
            $item = clone ($searchResultPrototype);
            $hydrator->hydrate($result, $item);
            $list->addItem($item);
        }

        return $list;
    }
}
