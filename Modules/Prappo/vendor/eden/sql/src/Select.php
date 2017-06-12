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
 * Generates select query string syntax
 *
 * @vendor   Eden
 * @package  Sql
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Select extends Query
{
    /**
     * @var string|null $select List of columns
     */
    protected $select   = null;

    /**
     * @var string|null $from Main table
     */
    protected $from = null;

    /**
     * @var array|null $joins List of relatoinal joins
     */
    protected $joins = null;

    /**
     * @var array $where List of filters
     */
    protected $where = array();

    /**
     * @var array $sortBy List of order and directions
     */
    protected $sortBy = array();

    /**
     * @var array $group List of "group bys"
     */
    protected $group = array();

    /**
     * @var int|null $page Pagination start
     */
    protected $page = null;

    /**
     * @var int|null $length Pagination range
     */
    protected $length = null;
    
    /**
     * Construct: Set the columns, if any
     *
     * @param string|null $select Column names
     */
    public function __construct($select = '*')
    {
        $this->select($select);
    }
    
    /**
     * From clause
     *
     * @param *string $from Main table
     *
     * @return Eden\Sql\Select
     */
    public function from($from)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->from = $from;
        return $this;
    }
    
    /**
     * Returns the string version of the query
     *
     * @return string
     */
    public function getQuery()
    {
        $joins = empty($this->joins) ? '' : implode(' ', $this->joins);
        $where = empty($this->where) ? '' : 'WHERE '.implode(' AND ', $this->where);
        $sort = empty($this->sortBy) ? '' : 'ORDER BY '.implode(', ', $this->sortBy);
        $limit = is_null($this->page) ? '' : 'LIMIT ' . $this->page .',' .$this->length;
        $group = empty($this->group) ? '' : 'GROUP BY ' . implode(', ', $this->group);
        
        $query = sprintf(
            'SELECT %s FROM %s %s %s %s %s %s;',
            $this->select,
            $this->from,
            $joins,
            $where,
            $group,
            $sort,
            $limit
        );
        
        return str_replace('  ', ' ', $query);
    }
    
    /**
     * Group by clause
     *
     * @param *string|array $group List of "group bys"
     *
     * @return Eden\Sql\Select
     */
    public function groupBy($group)
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
     * Inner join clause
     *
     * @param *string $table Table name to join
     * @param *string $where Filter/s
     * @param bool    $using Whether to use "using" syntax (as opposed to "on")
     *
     * @return Eden\Sql\Select
     */
    public function innerJoin($table, $where, $using = true)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string')
            //Argument 3 must be a boolean
            ->test(3, 'bool');
        
        return $this->join('INNER', $table, $where, $using);
    }
    
    /**
     * Allows you to add joins of different types
     * to the query
     *
     * @param *string $type  Join type
     * @param *string $table Table name to join
     * @param *string $where Filter/s
     * @param bool    $using Whether to use "using" syntax (as opposed to "on")
     *
     * @return Eden\Sql\Select
     */
    public function join($type, $table, $where, $using = true)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string')
            //Argument 3 must be a string
            ->test(3, 'string')
            //Argument 4 must be a boolean
            ->test(4, 'bool');
        
        $linkage = $using ? 'USING ('.$where.')' : ' ON ('.$where.')';
        $this->joins[] = $type.' JOIN ' . $table . ' ' . $linkage;
        
        return $this;
    }
    
    /**
     * Left join clause
     *
     * @param *string $table Table name to join
     * @param *string $where Filter/s
     * @param bool    $using Whether to use "using" syntax (as opposed to "on")
     *
     * @return Eden\Sql\Select
     */
    public function leftJoin($table, $where, $using = true)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string')
            //Argument 3 must be a boolean
            ->test(3, 'bool');
        
        return $this->join('LEFT', $table, $where, $using);
    }
    
    /**
     * Limit clause
     *
     * @param *string|int $page   Pagination start
     * @param *string|int $length Pagination range
     *
     * @return Eden\Sql\Select
     */
    public function limit($page, $length)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a number
            ->test(1, 'numeric')
            //Argument 2 must be a number
            ->test(2, 'numeric');
        
        $this->page = $page;
        $this->length = $length;

        return $this;
    }
    
    /**
     * Outer join clause
     *
     * @param *string $table Table name to join
     * @param *string $where Filter/s
     * @param bool    $using Whether to use "using" syntax (as opposed to "on")
     *
     * @return Eden\Sql\Select
     */
    public function outerJoin($table, $where, $using = true)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string')
            //Argument 3 must be a boolean
            ->test(3, 'bool');
        
        return $this->join('OUTER', $table, $where, $using);
    }
    
    /**
     * Right join clause
     *
     * @param *string $table Table name to join
     * @param *string $where Filter/s
     * @param bool    $using Whether to use "using" syntax (as opposed to "on")
     *
     * @return Eden\Sql\Select
     */
    public function rightJoin($table, $where, $using = true)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string')
            //Argument 3 must be a boolean
            ->test(3, 'bool');
        
        return $this->join('RIGHT', $table, $where, $using);
    }
    
    /**
     * Select clause
     *
     * @param string $select Select columns
     *
     * @return Eden\Sql\Select
     */
    public function select($select = '*')
    {
        //Argument 1 must be a string or array
        Argument::i()->test(1, 'string', 'array');
        
        //if select is an array
        if (is_array($select)) {
            //transform into a string
            $select = implode(', ', $select);
        }
        
        $this->select = $select;
        
        return $this;
    }
    
    /**
     * Order by clause
     *
     * @param *string $field Column name
     * @param string  $order Direction
     *
     * @return Eden\Sql\Select
     */
    public function sortBy($field, $order = 'ASC')
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        $this->sortBy[] = $field . ' ' . $order;
        
        return $this;
    }
    
    /**
     * Where clause
     *
     * @param array|string Filter/s
     *
     * @return Eden\Sql\Select
     */
    public function where($where)
    {
        //Argument 1 must be a string or array
        Argument::i()->test(1, 'string', 'array');
        
        if (is_string($where)) {
            $where = array($where);
        }
        
        $this->where = array_merge($this->where, $where);
        
        return $this;
    }
}
