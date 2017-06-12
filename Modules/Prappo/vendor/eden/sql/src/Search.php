<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Sql;

/**
 * Sql Search
 *
 * @vendor   Eden
 * @package  Sql
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Search extends Base
{
    /**
     * @const string LEFT Join type
     */
    const LEFT  = 'LEFT';

    /**
     * @const string RIGHT Join type
     */
    const RIGHT = 'RIGHT';

    /**
     * @const string INNER Join type
     */
    const INNER = 'INNER';

    /**
     * @const string OUTER Join type
     */
    const OUTER = 'OUTER';

    /**
     * @const string ASC Sort direction
     */
    const ASC   = 'ASC';

    /**
     * @const string DESC Sort direction
     */
    const DESC  = 'DESC';

    /**
     * @var Eden\Sql\Index|null $database Database object
     */
    protected $database = null;

    /**
     * @var string|null $table Table name
     */
    protected $table = null;

    /**
     * @var array $columns List of columns
     */
    protected $columns = array();

    /**
     * @var array $join List of relational joins
     */
    protected $join = array();

    /**
     * @var array $filter List of filters
     */
    protected $filter = array();

    /**
     * @var array $sort List of orders and directions
     */
    protected $sort = array();

    /**
     * @var array $group List of "group bys"
     */
    protected $group = array();

    /**
     * @var array $start Pagination start
     */
    protected $start = 0;

    /**
     * @var array $range Pagination range
     */
    protected $range = 0;

    /**
     * @var string $model Model name
     */
    protected $model = Index::MODEL;

    /**
     * @var string $collection Collection name
     */
    protected $collection = Index::COLLECTION;
    
    /**
     * Magical processing of sortBy
     * and filterBy Methods
     *
     * @param *string $name Name of method
     * @param *array  $args Arguments to pass
     *
     * @return mixed
     */
    public function __call($name, $args)
    {
        //if method starts with filterBy
        if (strpos($name, 'filterBy') === 0) {
            //ex. filterByUserName('Chris', '-')
            //choose separator
            $separator = '_';
            if (isset($args[1]) && is_scalar($args[1])) {
                $separator = (string) $args[1];
            }
            
            //transform method to column name
            $key = \Eden_String_Index::i($name)
                ->substr(8)
                ->preg_replace("/([A-Z0-9])/", $separator."$1")
                ->substr(strlen($separator))
                ->strtolower()
                ->get();
            
            //if arg isn't set
            if (!isset($args[0])) {
                //default is null
                $args[0] = null;
            }
            
            //generate key
            if (is_array($args[0])) {
                $key = $key.' IN %s';
            } else {
                $key = $key.'=%s';
            }
                
            //add it to the search filter
            $this->addFilter($key, $args[0]);
            
            return $this;
        }
        
        //if method starts with sortBy
        if (strpos($name, 'sortBy') === 0) {
            //ex. sortByUserName('Chris', '-')
            //determine separator
            $separator = '_';
            if (isset($args[1]) && is_scalar($args[1])) {
                $separator = (string) $args[1];
            }
            
            //transform method to column name
            $key = \Eden_String_Index::i($name)
                ->substr(6)
                ->preg_replace("/([A-Z0-9])/", $separator."$1")
                ->substr(strlen($separator))
                ->strtolower()
                ->get();
            
            //if arg isn't set
            if (!isset($args[0])) {
                //default is null
                $args[0] = null;
            }
                
            //add it to the search sort
            $this->addSort($key, $args[0]);
            
            return $this;
        }
        
        try {
            return parent::__call($name, $args);
        } catch (\Exception $e) {
            Exception::i($e->getMessage())->trigger();
        }
    }
    
    /**
     * Construct: Store database
     *
     * @param Eden\Sql\Index $database Database object
     */
    public function __construct(Index $database)
    {
        $this->database = $database;
    }
    
    /**
     * Adds filter
     *
     * @param *string           sprintf format
     * @param string[,string..] sprintf values
     *
     * @return Eden\Sql\Search
     */
    public function addFilter()
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->filter[] = func_get_args();
        
        return $this;
    }
    
    /**
     * Adds Inner Join On
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function addInnerJoinOn($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::INNER, $table, $where, false);
        
        return $this;
    }
    
    /**
     * Adds Inner Join Using
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function addInnerJoinUsing($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::INNER, $table, $where, true);
        
        return $this;
    }
    
    /**
     * Adds Left Join On
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function addLeftJoinOn($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::LEFT, $table, $where, false);
        
        return $this;
    }
    
    /**
     * Adds Left Join Using
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function addLeftJoinUsing($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::LEFT, $table, $where, true);
        
        return $this;
    }
    
    /**
     * Adds Outer Join On
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function addOuterJoinOn($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::OUTER, $table, $where, false);
        
        return $this;
    }
    
    /**
     * Adds Outer Join Using
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function addOuterJoinUsing($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::OUTER, $table, $where, true);
        
        return $this;
    }
    
    /**
     * Adds Right Join On
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function addRightJoinOn($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::RIGHT, $table, $where, false);
        
        return $this;
    }
    
    /**
     * Adds Right Join Using
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function addRightJoinUsing($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::RIGHT, $table, $where, true);
        
        return $this;
    }
    
    /**
     * Adds sort
     *
     * @param *string $column Column name
     * @param string  $order  ASC or DESC
     *
     * @return Eden\Sql\Search
     */
    public function addSort($column, $order = self::ASC)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        if ($order != self::DESC) {
            $order = self::ASC;
        }
        
        $this->sort[$column] = $order;
        
        return $this;
    }
    
    /**
     * Returns the results in a collection
     *
     * @return Eden\Sql\Collection
     */
    public function getCollection()
    {
        $collection = trim(str_replace('\\', '_', $this->collection), '_');
        return $this->$collection()
            ->setDatabase($this->database)
            ->setTable($this->table)
            ->setModel($this->model)
            ->set($this->getRows());
    }
    
    /**
     * Returns the one result in a model
     *
     * @param int $index Row index to return
     *
     * @return Eden\Sql\Model
     */
    public function getModel($index = 0)
    {
        Argument::i()->test(1, 'int');
        return $this->getCollection()->offsetGet($index);
    }
    
    /**
     * Returns the one result
     *
     * @param int         $index  Row index to return
     * @param string|null $column Specific column to return
     *
     * @return array|null
     */
    public function getRow($index = 0, $column = null)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string or int
            ->test(1, 'string', 'int')
            //Argument 2 must be a string or null
            ->test(2, 'string', 'null');
        
        if (is_string($index)) {
            $column = $index;
            $index = 0;
        }
        
        $rows = $this->getRows();
        
        if (!is_null($column) && isset($rows[$index][$column])) {
            return $rows[$index][$column];
        } else if (is_null($column) && isset($rows[$index])) {
            return $rows[$index];
        }
        
        return null;
    }
    
    /**
     * Returns the array rows
     *
     * @return array
     */
    public function getRows()
    {
        $query = $this->getQuery();
        
        if (!empty($this->columns)) {
            $query->select(implode(', ', $this->columns));
        }
        
        foreach ($this->sort as $key => $value) {
            $query->sortBy($key, $value);
        }
        
        if ($this->range) {
            $query->limit($this->start, $this->range);
        }
        
        if (!empty($this->group)) {
            $query->groupBy($this->group);
        }
        
        return $this->database->query($query, $this->database->getBinds());
    }
    
    /**
     * Returns the total results
     *
     * @return int
     */
    public function getTotal()
    {
        $query = $this->getQuery()->select('COUNT(*) as total');
        
        $rows = $this->database->query($query, $this->database->getBinds());
        
        if (!isset($rows[0]['total'])) {
            return 0;
        }
        
        return $rows[0]['total'];
    }
    
    /**
     * Adds Inner Join On
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function innerJoinOn($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::INNER, $table, $where, false);
        
        return $this;
    }
    
    /**
     * Adds Inner Join Using
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function innerJoinUsing($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::INNER, $table, $where, true);
        
        return $this;
    }
    
    /**
     * Adds Left Join On
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function leftJoinOn($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::LEFT, $table, $where, false);
        
        return $this;
    }
    
    /**
     * Adds Left Join Using
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function leftJoinUsing($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::LEFT, $table, $where, true);
        
        return $this;
    }
    
    /**
     * Adds Outer Join On
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function outerJoinOn($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::OUTER, $table, $where, false);
        
        return $this;
    }
    
    /**
     * Adds Outer Join USing
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function outerJoinUsing($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::OUTER, $table, $where, true);
        
        return $this;
    }
    
    /**
     * Adds Right Join On
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function rightJoinOn($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::RIGHT, $table, $where, false);
        
        return $this;
    }
    
    /**
     * Adds Right Join Using
     *
     * @param *string            $table Table name
     * @param *string[,string..] $where Filter/s
     *
     * @return Eden\Sql\Search
     */
    public function rightJoinUsing($table, $where)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $where = func_get_args();
        $table = array_shift($where);
        
        $this->join[] = array(self::RIGHT, $table, $where, true);
        
        return $this;
    }
    
    /**
     * Sets Columns
     *
     * @param string[,string..]|array $columns List of table columns
     *
     * @return Eden\Sql\Search
     */
    public function setColumns($columns)
    {
        if (!is_array($columns)) {
            $columns = func_get_args();
        }
        
        $this->columns = $columns;
        
        return $this;
    }
    
    /**
     * Sets default collection
     *
     * @param string $collection Collection class name
     *
     * @return Eden\Sql\Search
     */
    public function setCollection($collection)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        if ($collection != Index::COLLECTION
        && !is_subclass_of($collection, Index::COLLECTION)) {
            Exception::i()
                ->setMessage(Exception::NOT_SUB_COLLECTION)
                ->addVariable($collection)
                ->trigger();
        }
        
        $this->collection = $collection;
        return $this;
    }
    
    /**
     * Group by clause
     *
     * @param string $group Column name
     *
     * @return Eden\Sql\Search
     */
    public function setGroup($group)
    {
        //Argument 1 must be a string or array
        Argument::i()->test(1, 'string', 'array');
            
        if (is_string($group)) {
            $group = array($group);
        }
        
        $this->group = $group;
        return $this;
    }
    
    /**
     * Sets default model
     *
     * @param string $model Model class name
     *
     * @return Eden\Sql\Search
     */
    public function setModel($model)
    {
        Argument::i()->test(1, 'string');
        
        if ($model != Index::MODEL
        && !is_subclass_of($model, Index::MODEL)) {
            Exception::i()
                ->setMessage(Exception::NOT_SUB_MODEL)
                ->addVariable($model)
                ->trigger();
        }
        
        $this->model = $model;
        return $this;
    }
    
    /**
     * Sets the pagination page
     *
     * @param int $page Pagination page
     *
     * @return Eden\Sql\Search
     */
    public function setPage($page)
    {
        Argument::i()->test(1, 'int');
        
        if ($page < 1) {
            $page = 1;
        }
        
        $this->start = ($page - 1) * $this->range;
        
        return $this;
    }
    
    /**
     * Sets the pagination range
     *
     * @param int $range Pagination range
     *
     * @return Eden\Sql\Search
     */
    public function setRange($range)
    {
        Argument::i()->test(1, 'int');
        
        if ($range < 0) {
            $range = 25;
        }
        
        $this->range = $range;
        
        return $this;
    }
    
    /**
     * Sets the pagination start
     *
     * @param int $start Pagination start
     *
     * @return Eden\Sql\Search
     */
    public function setStart($start)
    {
        Argument::i()->test(1, 'int');
        
        if ($start < 0) {
            $start = 0;
        }
        
        $this->start = $start;
        
        return $this;
    }
    
    /**
     * Sets Table
     *
     * @param string $table Table class name
     *
     * @return Eden\Sql\Search
     */
    public function setTable($table)
    {
        Argument::i()->test(1, 'string');
        $this->table = $table;
        return $this;
    }
    
    /**
     * Builds query based on the data given
     *
     * @return string
     */
    protected function getQuery()
    {
        $query = $this->database->select()->from($this->table);
        
        foreach ($this->join as $join) {
            if (!is_array($join[2])) {
                $join[2] = array($join[2]);
            }
            
            $where = array_shift($join[2]);
            if (!empty($join[2])) {
                foreach ($join[2] as $i => $value) {
                    $join[2][$i] = $this->database->bind($value);
                }
                
                $where = vsprintf($where, $join[2]);
            }
            
            $query->join($join[0], $join[1], $where, $join[3]);
        }
        
        foreach ($this->filter as $i => $filter) {
            //array('post_id=%s AND post_title IN %s', 123, array('asd'));
            $where = array_shift($filter);
            if (!empty($filter)) {
                foreach ($filter as $i => $value) {
                    $filter[$i] = $this->database->bind($value);
                }
                
                $where = vsprintf($where, $filter);
            }
            
            $query->where($where);
        }
        
        return $query;
    }
}
