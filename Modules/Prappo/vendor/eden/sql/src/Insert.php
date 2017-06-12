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
 * Generates insert query string syntax
 *
 * @vendor   Eden
 * @package  Sql
 * @author     Christian Blanquera cblanquera@openovate.com
 */
class Insert extends Query
{
    /**
     * @var array $setKey List of keys
     */
    protected $setKey = array();

    /**
     * @var array $setVal List of values
     */
    protected $setVal = array();
    
    /**
     * Set the table, if any
     *
     * @param string|null $table Table name
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
        $multiValList = array();
        foreach ($this->setVal as $val) {
            $multiValList[] = '('.implode(', ', $val).')';
        }
        
        return 'INSERT INTO '
            . $this->table . ' ('.implode(', ', $this->setKey)
            . ') VALUES ' . implode(", \n", $multiValList).';';
    }
    
    /**
     * Set clause that assigns a given field name to a given value.
     * You can also use this to add multiple rows in one call
     *
     * @param *string      $key   The column name
     * @param *scalar|null $value The column value
     * @param int          $index For what row is this for?
     *
     * @return Eden\Sql\Insert
     */
    public function set($key, $value, $index = 0)
    {
        //argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be scalar or null
            ->test(2, 'scalar', 'null');
        
        if (!in_array($key, $this->setKey)) {
            $this->setKey[] = $key;
        }
        
        if (is_null($value)) {
            $value = 'null';
        } else if (is_bool($value)) {
            $value = $value ? 1 : 0;
        }
        
        $this->setVal[$index][] = $value;
        return $this;
    }
    
    /**
     * Set the table name in which you want to delete from
     *
     * @param string $table The table name
     *
     * @return Eden\Sql\Insert
     */
    public function setTable($table)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->table = $table;
        return $this;
    }
}
