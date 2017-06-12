<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

/**
 * Array object 
 *
 * @package  Eden
 * @category Array
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Eden_Array_Index 
    extends Eden_Array_Base 
    implements ArrayAccess, Iterator, Serializable, Countable
{
    /**
     * @const string PRE Flag that a PHP method uses the array in the first argument
     */
    const PRE = 'pre';
       
    /**
     * @const string POST Flag that a PHP method uses the array in the last argument
     */
    const POST = 'post';
       
    /**
     * @const string REFERENCE Flag that a PHP method uses the array as a reference pass
     */
    const REFERENCE = 'reference';
       
    /**
     * @var array $data The data being manipulated
     */
    public $data = array();
       
    /**
     * @var array $original The data before any manipulations
     */
    public $original = array();
    
    /**
     * Dermines if the missing method is actually a PHP call.
     * If so, call it.
     *
     * @param *string $name Name of method
     * @param *array  $args Arguments to pass
     *
     * @return mixed
     */
    public function __call($name, $args)  
    {
        Eden_Array_Argument::i()
            //argument 1 must be a string
            ->test(1, 'string') 
            //argument 2 must be an array
            ->test(2, 'array'); 

        //if the method starts with get
        if (strpos($name, 'get') === 0) {
            //getUserName('-')
            $separator = '_';
            if (isset($args[0]) && is_scalar($args[0])) {
                $separator = (string) $args[0];
            }

            $key = preg_replace("/([A-Z0-9])/", $separator."$1", $name);
            //get rid of get
            $key = strtolower(substr($key, 3+strlen($separator)));

            if (isset($this->data[$key])) {
                return $this->data[$key];
            }

            return null;
        } else if (strpos($name, 'set') === 0) {
            //setUserName('Chris', '-')
            $separator = '_';
            if (isset($args[1]) && is_scalar($args[1])) {
                $separator = (string) $args[1];
            }

            $key = preg_replace("/([A-Z0-9])/", $separator."$1", $name);

            //get rid of set
            $key = strtolower(substr($key, 3+strlen($separator)));

            $this->__set($key, isset($args[0]) ? $args[0] : null);

            return $this;
        }
        
        $name = $this->getMethod($name);

        //if no type
        if (!isset(self::$_methods[$name])) {
            //we don't process anything else
            //call the parent
            return parent::__call($name, $args);
        }

        //case different types
        switch(self::$_methods[$name]) {
            case self::PRE:
                //if pre, we add it first into the args
                array_unshift($args, $this->data);
                break;
            case self::POST:
                //if post, we add it last into the args
                array_push($args, $this->data);
                break;
            case self::REFERENCE:
                //if reference, we add it first 
                //into the args and call it
                $result = call_user_func_array($name, array_merge(array(&$this->data), $args));
                
                if ($name === 'array_shift' || $name === 'array_pop') {
                    return $result;
                }
                
                return $this;
        }
        
        //call the method
        $result = call_user_func_array($name, $args);

        //if the result is a string
        if (is_string($result) && class_exists('Eden_String_Index')) {
            //if this class is a string type
            if ($this instanceof Eden_String_Index) {
                //set value
                $this->data = $result;
                return $this;    
            }

            //return string class
            return Eden_String_Index::i($result);
        }

        //if the result is an array
        if (is_array($result)) {
            //if this class is a array type
            if ($this instanceof Eden_Array_Index) {
                //set value
                $this->data = $result;
                return $this;
            }

            //return array class
            return Eden_Array_Index::i($result);
        }

        return $result;
    }

    /**
     * Preset the data and the original
     *
     * @param *mixed $data The initial data
     *
     * @return void
     */
    public function __construct($data = null) 
    {
        //if there is more arguments or data is not an array
        if (func_num_args() > 1 || (!is_null($data) && !is_array($data))) {
            //just get the args
            $data = func_get_args();
        }
        
        if ($data) {
            $this->original = $this->data = $data;
        }
    }

    /**
     * Allow object property magic to redirect to the data variable
     *
     * @param *string $name  The name of the supposed property
     * @param *mixed  $value The value of the supposed property
     *
     * @return void
     */
    public function __get($name) 
    {
        //argument 1 must be a string
        Eden_Array_Argument::i()->test(1, 'string');

        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        
        return null;
    }

    /**
     * Allow object property magic to redirect to the data variable
     *
     * @param *string $name  The name of the supposed property
     * @param *mixed  $value The value of the supposed property
     *
     * @return void
     */
    public function __set($name, $value) 
    {
        //argument 1 must be a string
        Eden_Array_Argument::i()->test(1, 'string');

        $this->data[$name] = $value;
    }
    
    /**
     * If we output this to string we should see it as json
     *
     * @return string
     */
    public function __toString() 
    {
        return json_encode($this->get());
    }
    
    /**
     * Copies the value of source key into destination key
     *
     * @param *string $source      The key in the array to copy from
     * @param *string $destination The key in which to put the value into
     *
     * @return Eden_Array_Index
     */
    public function copy($source, $destination)  
    {
        Eden_Array_Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')  
            //argument 2 must be a string
            ->test(2, 'string'); 

        $this->data[$destination] = $this->data[$source];
        return $this;
    }

    /**
     * returns size using the Countable interface
     *
     * @return string
     */
    public function count()  
    {
        return count($this->data);
    }

    /**
     * Removes a row in an array and adjusts all the indexes
     *
     * @param *scalar $key the key to leave out
     *
     * @return this
     */
    public function cut($key)  
    {
        //argument 1 must be scalar
        Eden_Array_Argument::i()->test(1, 'scalar');

        //if nothing to cut
        if (!isset($this->data[$key])) {
            //do nothing
            return $this;
        }

        //unset the value
       unset($this->data[$key]);
        //reindex the list
        $this->data = array_values($this->data);
        return $this;
    }

    /**
     * Returns the current item
     * For Iterator interface
     *
     * @return void
     */
    public function current()  
    {
        return current($this->data);
    }

    /**
     * Loops through returned result sets
     *
     * @param *function $callback The handler to call on each iteration 
     *
     * @return Eden_Array_Index
     */
    public function each($callback)  
    {
        Eden_Array_Argument::i()->test(1, 'callable');

        foreach ($this->data as $key => $value) {
            call_user_func($callback, $key, $value);
        }

        return $this;
    }
    
    /**
     * Returns the value
     *
     * @param bool $modfied Whether to get the modified or original version
     *
     * @return string
     */
    public function get($modified = true) 
    {
        //argument 1 must be a bool
        Eden_Array_Argument::i()->test(1, 'bool');

        return $modified ? $this->data : $this->original;
    }

    /**
     * Returns if the data is empty
     *
     * @return bool
     */
    public function isEmpty() 
    {
        return empty($this->data);
    }

    /**
     * Returns th current position
     * For Iterator interface
     *
     * @return void
     */
    public function key() 
    {
        return key($this->data);
    }

    /**
     * Increases the position
     * For Iterator interface
     *
     * @return void
     */
    public function next() 
    {
        next($this->data);
    }

    /**
     * isset using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to test if exists
     *
     * @return bool
     */
    public function offsetExists($offset) 
    {
        //argument 1 must be scalar, null or bool
        Eden_Array_Argument::i()->test(1, 'scalar', 'null', 'bool');

        return isset($this->data[$offset]);
    }

    /**
     * returns data using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to get
     *
     * @return mixed
     */
    public function offsetGet($offset) 
    {
        //argument 1 must be scalar, null or bool
        Eden_Array_Argument::i()->test(1, 'scalar', 'null', 'bool');

        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * Sets data using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to set
     * @param mixed             $value  The value the key should be set to
     *
     * @return void
     */
    public function offsetSet($offset, $value) 
    {
        //argument 1 must be scalar, null or bool
        Eden_Array_Argument::i()->test(1, 'scalar', 'null', 'bool');

        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * unsets using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to unset
     *
     * @return void
     */
    public function offsetUnset($offset) 
    {
        //argument 1 must be scalar, null or bool
        Eden_Array_Argument::i()->test(1, 'scalar', 'null', 'bool');

        unset($this->data[$offset]);
    }

    /**
     * Inserts a row in an array after the given index and adjusts all the indexes
     *
     * @param *scalar $after the key we are looking for to past after
     * @param *mixed  $value the value to paste
     * @param scalar  $key   the key to paste along with the value
     *
     * @return Eden_Array_Index
     */
    public function paste($after, $value, $key = null) 
    {
        //Argument test
        Eden_Array_Argument::i()
            //Argument 1 must be a scalar
            ->test(1, 'scalar')                
            //Argument 3 must be a scalar or null
            ->test(3, 'scalar', 'null');    

        $list = array();
        //for each row
        foreach ($this->data as $i => $val) {
            //add this row back to the list
            $list[$i] = $val;

            //if this is not the key we are
            //suppose to paste after 
            if ($after != $i) {
                //do nothing more
                continue;
            }

            //if there was a key involved
            if (!is_null($key)) {
                //lets add the new value
                $list[$key] = $value;
                continue;
            }

            //lets add the new value
            $list[] = $arrayValue;
        }

        //if there was no key involved
        if (is_null($key)) {
            //reindex the array
            $list = array_values($list);
        }

        //give it back
        $this->data = $list;

        return $this;
    }

    /**
     * Reverts changes back to the original
     *
     * @return Eden_Array_Index
     */
    public function revert() 
    {
        $this->data = $this->original;
        return $this;
    }

    /**
     * Rewinds the position
     * For Iterator interface
     *
     * @return void
     */
    public function rewind() 
    {
        reset($this->data);
    }

    /**
     * returns serialized data using the Serializable interface
     *
     * @return string
     */
    public function serialize() 
    {
        return json_encode($this->data);
    }

    /**
     * Sets data
     *
     * @param mixed $value The initial set to modify
     *
     * @return Eden_Array_Index
     */
    public function set($value = null) 
    {
        if (is_null($value)) {
            $value = array();
        }
        
        if (!is_array($value)) {
            $value = func_get_args();
        }
        
        $this->__construct($value);
        
        return $this;
    }

    /**
     * sets data using the Serializable interface
     *
     * @param *string $data the set to enter in the class
     *
     * @return Eden_Array_Index
     */
    public function unserialize($data) 
    {
        //argument 1 must be a string
        Eden_Array_Argument::i()->test(1, 'string');

        $this->data = json_decode($data, true);

        return $this;
    }

    /**
     * Validates whether if the index is set
     * For Iterator interface
     *
     * @return bool
     */
    public function valid() 
    {
        return isset($this->data[$this->key()]);
    }
    
    /**
     * A PHP method excepts arrays in 3 ways, first argument,
     * last argument and as a reference
     *
     * @param string $name The name of the PHP method
     *
     * @return string|false
     */
    protected function getMethod($name) 
    {
        if (isset(self::$_methods[$name])) {
            return $name;
        }

        if (isset(self::$_methods['array_'.$name])) {
            return 'array_'.$name;
        }

        $uncamel = strtolower(preg_replace("/([A-Z])/", "_$1", $name));

        if (isset(self::$_methods[$uncamel])) {
            return $uncamel;
        }

        if (isset(self::$_methods['array_'.$uncamel])) {
            return 'array_'.$uncamel;
        }

        return $name;
    }

    /**
     * @var array $_methods The list of supported PHP methods
     */
    protected static $_methods = array(
        'array_change_key_case' => self::PRE,
        'array_chunk' => self::PRE,
        'array_combine' => self::PRE,
        'array_count_values' => self::PRE,
        'array_diff_assoc' => self::PRE,
        'array_diff_key' => self::PRE,
        'array_diff_uassoc' => self::PRE,
        'array_diff_ukey' => self::PRE,
        'array_diff' => self::PRE,
        'array_fill_keys' => self::PRE,
        'array_filter' => self::PRE,
        'array_flip' => self::PRE,
        'array_intersect_assoc' => self::PRE,
        'array_intersect_key' => self::PRE,
        'array_intersect_uassoc' => self::PRE,
        'array_intersect_ukey' => self::PRE,
        'array_intersect' => self::PRE,
        'array_keys' => self::PRE,
        'array_merge_recursive' => self::PRE,
        'array_merge' => self::PRE,
        'array_pad' => self::PRE,
        'array_reverse' => self::PRE,
        'array_slice' => self::PRE,
        'array_sum' => self::PRE,
        'array_udiff_assoc' => self::PRE,
        'array_udiff_uassoc' => self::PRE,
        'array_udiff' => self::PRE,
        'array_uintersect_assoc' => self::PRE,
        'array_uintersect_uassoc' => self::PRE,
        'array_uintersect' => self::PRE,
        'array_unique' => self::PRE,
        'array_values' => self::PRE,    
        'count' => self::PRE,
        'extract' => self::PRE,
        'sizeof' => self::PRE,
        'array_fill' => self::POST,
        'array_map' => self::POST,
        'array_search' => self::POST,    
        'implode' => self::POST,    
        'in_array' => self::POST,
        'array_shift' => self::REFERENCE,
        'array_pop' => self::REFERENCE,
        'array_push' => self::REFERENCE,
        'array_unshift' => self::REFERENCE,
        'array_splice' => self::REFERENCE,
        'array_walk_recursive' => self::REFERENCE,
        'array_walk' => self::REFERENCE,    
        'arsort' => self::REFERENCE,
        'asort' => self::REFERENCE,    
        'krsort' => self::REFERENCE,
        'ksort' => self::REFERENCE,    
        'natcasesort' => self::REFERENCE,
        'natsort' => self::REFERENCE,    
        'rsort' => self::REFERENCE,    
        'shuffle' => self::REFERENCE,
        'sort' => self::REFERENCE,    
        'uasort' => self::REFERENCE,
        'uksort' => self::REFERENCE,    
        'usort' => self::REFERENCE);
}
