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
 * Sql Model
 *
 * @vendor   Eden
 * @package  Sql
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Model extends \Eden\Model\Index
{
    /**
     * @const string COLUMNS The name of the columns
     */
    const COLUMNS = 'columns';

    /**
     * @const string PRIMARY Primary keyword
     */
    const PRIMARY = 'primary';

    /**
     * @const string DATETIME Default datetime format
     */
    const DATETIME = 'Y-m-d h:i:s';

    /**
     * @const string DATE Default date format
     */
    const DATE = 'Y-m-d';

    /**
     * @const string TIME Default time format
     */
    const TIME = 'h:i:s';

    /**
     * @const string TIMESTAMP Default timestamp format
     */
    const TIMESTAMP = 'U';
    
    /**
     * @var string|null $table Table name
     */
    protected $table = null;
    
    /**
     * @var Eden\Sql\Index|null $database Sql database object
     */
    protected $database = null;
    
    /**
     * @var array $meta Stored table meta data
     */
    protected static $meta = array();
    
    /**
     * Useful method for formating a time column.
     *
     * @param *string $column Column name
     * @param string  $format datetime format
     *
     * @return Eden\Sql\Model
     */
    public function formatTime($column, $format = self::DATETIME)
    {
        //Argument Test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 2 must be a string
            ->test(2, 'string');
        
        //if the column isn't set
        if (!isset($this->data[$column])) {
            //do nothing more
            return $this;
        }
        
        if (is_numeric($this->data[$column])) {
            $this->data[$column] = (int) $this->data[$column];
        }
        
        //if this is column is a string
        if (is_string($this->data[$column])) {
            //make into time
            $this->data[$column] = strtotime($this->data[$column]);
        }
        
        //if this column is not an integer
        if (!is_int($this->data[$column])) {
            //do nothing more
            return $this;
        }
        
        //set it
        $this->data[$column] = date($format, $this->data[$column]);
        
        return $this;
    }
    
    /**
     * Inserts model to database
     *
     * @param string|null         $table    Table name
     * @param Eden\Sql\Index|null $database Dabase object
     *
     * @return Eden\Sql\Model
     */
    public function insert($table = null, Index $database = null)
    {
        //Argument 1 must be a string
        $error = Argument::i()->test(1, 'string', 'null');
        
        //if no table
        if (is_null($table)) {
            //if no default table either
            if (!$this->table) {
                //throw error
                $error->setMessage(Exception::TABLE_NOT_SET)->trigger();
            }
            
            $table = $this->table;
        }
        
        //if no database
        if (is_null($database)) {
            //and no default database
            if (!$this->database) {
                $error->setMessage(Exception::DATABASE_NOT_SET)->trigger();
            }
            
            $database = $this->database;
        }
        
        //get the meta data, the valid column values and whether is primary is set
        $meta = $this->getMeta($table, $database);
        $data = $this->getValidColumns(array_keys($meta[self::COLUMNS]));
        
        //update original data
        $this->original = $this->data;
        
        //we insert it
        $database->insertRow($table, $data);
        
        //only if we have 1 primary key
        if (count($meta[self::PRIMARY]) == 1) {
            //set the primary key
            $this->data[$meta[self::PRIMARY][0]] = $database->getLastInsertedId();
        }
        
        return $this;
    }
    
    /**
     * Removes model from database
     *
     * @param string|null         $table    Table name
     * @param Eden\Sql\Index|null $database Dabase object
     * @param string|array|null   $primary  The primary column if you know it
     *
     * @return Eden\Sql\Model
     */
    public function remove(
        $table = null,
        Index $database = null,
        $primary = null
    ) {
        //Argument test
        $error = Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string', 'null')
            //Argument 3 must be a string, array or null
            ->test(3, 'string', 'array', 'null');
        
        //if no table
        if (is_null($table)) {
            //if no default table either
            if (!$this->table) {
                //throw error
                $error->setMessage(Exception::TABLE_NOT_SET)->trigger();
            }
            
            $table = $this->table;
        }
        
        //if no database
        if (is_null($database)) {
            //and no default database
            if (!$this->database) {
                $error->setMessage(Exception::DATABASE_NOT_SET)->trigger();
            }
            
            $database = $this->database;
        }
        
        //get the meta data and valid columns
        $meta = $this->getMeta($table, $database);
        $data = $this->getValidColumns(array_keys($meta[self::COLUMNS]));
        
        if (is_null($primary)) {
            $primary = $meta[self::PRIMARY];
        }
        
        if (is_string($primary)) {
            $primary = array($primary);
        }
        
        $filter = array();
        //for each primary key
        foreach ($primary as $column) {
            //if the primary is not set
            if (!isset($data[$column])) {
                //we can't do a remove
                //do nothing more
                return $this;
            }
            
            //add the condition to the filter
            $filter[] = array($column.'=%s', $data[$column]);
        }
        
        //we delete it
        $database->deleteRows($table, $filter);
        
        return $this;
    }
    
    /**
     * Inserts or updates model to database
     *
     * @param string|null         $table    Table name
     * @param Eden\Sql\Index|null $database Dabase object
     * @param string|array|null   $primary  The primary column if you know it
     *
     * @return Eden\Sql\Model
     */
    public function save(
        $table = null,
        Index $database = null,
        $primary = null
    ) {
        //argument test
        Argument::i()
            //Argument 1 must be a string or null
            ->test(1, 'string', 'null')
            //Argument 1 must be a string or null
            ->test(3, 'string', 'null');
        
        //if no table
        if (is_null($table)) {
            //if no default table either
            if (!$this->table) {
                //throw error
                Exception::i()->setMessage(Exception::TABLE_NOT_SET)->trigger();
            }
            
            $table = $this->table;
        }
        
        //if no database
        if (is_null($database)) {
            //and no default database
            if (!$this->database) {
                Exception::i()->setMessage(Exception::DATABASE_NOT_SET)->trigger();
            }
            
            $database = $this->database;
        }
        
        //get the meta data, the valid column values and whether is primary is set
        $meta = $this->getMeta($table, $database);
        
        if (is_null($primary)) {
            $primary = $meta[self::PRIMARY];
        }
        
        if (is_string($primary)) {
            $primary = array($primary);
        }
        
        $primarySet = $this->isPrimarySet($primary);
        
        //update original data
        $this->original = $this->data;
        
        //if no primary meta or primary values are not set
        if (empty($primary) || !$primarySet) {
            return $this->insert($table, $database);
        }
        
        return $this->update($table, $database, $primary);
    }
    
    /**
     * Sets the default database
     *
     * @param Eden\Sql\Index $database A database object
     *
     * @return Eden\Sql\Model
     */
    public function setDatabase(Index $database)
    {
        $this->database = $database;
        return $this;
    }
    
    /**
     * Sets the default database
     *
     * @param string $table Table name
     *
     * @return Eden\Sql\Model
     */
    public function setTable($table)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $this->table  = $table;
        return $this;
    }
    
    /**
     * Updates model to database
     *
     * @param string|null         $table    Table name
     * @param Eden\Sql\Index|null $database Dabase object
     * @param string|array|null   $primary  The primary column if you know it
     *
     * @return Eden\Sql\Model
     */
    public function update(
        $table = null,
        Index $database = null,
        $primary = null
    ) {
        //argument test
        $error = Argument::i()
            //Argument 1 must be a string or null
            ->test(1, 'string', 'null')
            //Argument 1 must be a string or null
            ->test(3, 'string', 'null', 'array');
        
        //if no table
        if (is_null($table)) {
            //if no default table either
            if (!$this->table) {
                //throw error
                $error->setMessage(Exception::TABLE_NOT_SET)->trigger();
            }
            
            $table = $this->table;
        }
        
        //if no database
        if (is_null($database)) {
            //and no default database
            if (!$this->database) {
                $error->setMessage(Exception::DATABASE_NOT_SET)->trigger();
            }
            
            $database = $this->database;
        }
        
        //get the meta data, the valid column values and whether is primary is set
        $meta = $this->getMeta($table, $database);
        $data = $this->getValidColumns(array_keys($meta[self::COLUMNS]));
        
        //update original data
        $this->original = $this->data;
        
        //from here it means that this table has primary
        //columns and all primary values are set
        
        if (is_null($primary)) {
            $primary = $meta[self::PRIMARY];
        }
        
        if (is_string($primary)) {
            $primary = array($primary);
        }
        
        $filter = array();
        //for each primary key
        foreach ($primary as $column) {
            //add the condition to the filter
            $filter[] = array($column.'=%s', $data[$column]);
        }
        
        //we update it
        $database->updateRows($table, $data, $filter);
        
        return $this;
    }
    
    /**
     * Checks to see if the model is populated
     *
     * @param string|null         $table    Table name
     * @param Eden\Sql\Index|null $database Database object
     *
     * @return Eden\Sql\Model
     */
    protected function isLoaded($table = null, $database = null)
    {
        //if no table
        if (is_null($table)) {
            //if no default table either
            if (!$this->table) {
                return false;
            }
            
            $table = $this->table;
        }
        
        //if no database
        if (is_null($database)) {
            //and no default database
            if (!$this->database) {
                return false;
            }
            
            $database = $this->database;
        }
        
        $meta = $this->getMeta($table, $database);
        
        return $this->isPrimarySet($meta[self::PRIMARY]);
    }
    
    /**
     * Checks to see if we have a primary value/s set
     *
     * @param array $primary List of primary columns
     *
     * @return bool
     */
    protected function isPrimarySet(array $primary)
    {
        foreach ($primary as $column) {
            if (is_null($this[$column])) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Returns the table meta data
     *
     * @param string|null         $table    Table name
     * @param Eden\Sql\Index|null $database Database object
     *
     * @return array
     */
    protected function getMeta($table, $database)
    {
        $uid = spl_object_hash($database);
        if (isset(self::$meta[$uid][$table])) {
            return self::$meta[$uid][$table];
        }
        
        $columns = $database->getColumns($table);
        
        $meta = array();
        foreach ($columns as $i => $column) {
            $meta[self::COLUMNS][$column['Field']] = array(
                'type'      => $column['Type'],
                'key'       => $column['Key'],
                'default'   => $column['Default'],
                'empty'     => $column['Null'] == 'YES');
            
            if ($column['Key'] == 'PRI') {
                $meta[self::PRIMARY][] = $column['Field'];
            }
        }
        
        self::$meta[$uid][$table] = $meta;
        
        return $meta;
    }
    
    /**
     * Returns only the valid data given
     * the partiular table
     *
     * @param array $columns An unsorted list of possible columns
     *
     * @return array
     */
    protected function getValidColumns($columns)
    {
        $valid = array();
        foreach ($columns as $column) {
            if (!isset($this->data[$column])) {
                continue;
            }
            
            $valid[$column] = $this->data[$column];
        }
        
        return $valid;
    }
}
