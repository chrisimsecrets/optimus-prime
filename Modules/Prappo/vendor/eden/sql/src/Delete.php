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
 * Generates delete query string syntax
 *
 * @vendor   Eden
 * @package  Sql
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Delete extends Query
{
    /**
     * @var array $table Table name
     */
    protected $table = null;

    /**
     * @var array $where List of filters
     */
    protected $where = array();
    
    /**
     * Construct: Set the table, if any
     *
     * @param string|null $table The initial name of the table
     */
    public function __construct($table = null)
    {
        //Argument 1 must be a string or null
        Argument::i()->test(1, 'string', 'null');
        
        if (is_string($table)) {
            $this->setTable($table);
        }
    }
    
    /**
     * Returns the string version of the query
     *
     * @return string
     */
    public function getQuery()
    {
        return 'DELETE FROM '
            .$this->table.' WHERE '
            .implode(' AND ', $this->where).';';
    }
    
    /**
     * Set the table name in which you want to delete from
     *
     * @param string|null $table The initial name of the table
     *
     * @return Eden\Sql\Delete
     */
    public function setTable($table)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->table = $table;
        return $this;
    }
    
    /**
     * Where clause
     *
     * @param array|string $where The where clause
     *
     * @return Eden\Sql\Delete
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
