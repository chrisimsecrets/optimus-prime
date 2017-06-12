<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

/**
 * String Object
 *
 * @package  Eden
 * @category String
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Eden_String_Index extends Eden_String_Base
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
    public $data = '';

    /**
     * @var array $original The data before any manipulations
     */
    public $original = '';
    
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
        Eden_String_Argument::i()
            //argument 1 must be a string
            ->test(1, 'string') 
            //argument 2 must be an array
            ->test(2, 'array'); 

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
                call_user_func_array($name, array_merge(array(&$this->data), $args));
                return $this;
        }

        //call the method
        $result = call_user_func_array($name, $args);

        //if the result is a string
        if (is_string($result)) {
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
        if (is_array($result) && class_exists('Eden_Array_Index')) {
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
     * Preloads the string
     *
     * @param *scalar|null $data The initial data
     *
     * @return void
     */
    public function __construct($data = null) 
    {
        //argument 1 must be scalar
        Eden_String_Argument::i()->test(1, 'scalar', 'null');
        
        if ($data) {
            $data = (string) $data;

            $this->original = $this->data = $data;
        }
    }

    /**
     * If we output this to string we should see the raw string
     *
     * @return string
     */
    public function __toString() 
    {
        return $this->data;
    }
    
    /**
     * Camelizes a string
     *
     * @param string $prefix The delimiter to look for
     *
     * @return Eden_String_Index
     */
    public function camelize($prefix = '-') 
    {
        //argument 1 must be a string
        Eden_String_Argument::i()->test(1, 'string');
        $this->data = str_replace($prefix, ' ', $this->data);
        $this->data = str_replace(' ', '', ucwords($this->data));
        $this->data = strtolower(substr($this->data, 0, 1)).substr($this->data, 1);

        return $this;
    }

    /**
     * Transforms a string with caps and
     * space to a lower case dash string
     *
     * @return Eden_String_Index
     */
    public function dasherize() 
    {
        $this->data = preg_replace("/[^a-zA-Z0-9_\-\s]/i", '', $this->data);
        $this->data = str_replace(' ', '-', trim($this->data));
        $this->data = preg_replace("/-+/i", '-', $this->data);
        $this->data = strtolower($this->data);

        return $this;
    }
    
    /**
     * Returns the value
     *
     * @param bool $modified Whether to get the modified or original version
     *
     * @return bool
     */
    public function get($modified = true) 
    {
        //argument 1 must be a bool
        Eden_String_Argument::i()->test(1, 'bool');
        
        return $modified ? $this->data : $this->original;
    }
    
    /**
     * Reverts changes back to the original
     *
     * @return Eden_String_Index
     */
    public function revert() 
    {
        $this->data = $this->original;
        return $this;
    }
    
    /**
     * Sets data
     *
     * @param mixed $value The initial value
     *
     * @return Eden_String_Index
     */
    public function set($value = null) 
    {
        Eden_String_Argument::i()->test(1, 'scalar', 'null');
        
        if (is_null($value)) {
            $value = '';
        }
        
        $this->__construct($value);
        
        return $this;
    }

    /**
     * Titlizes a string
     *
     * @param string $prefix The delimeter to look for
     *
     * @return Eden_String_Index
     */
    public function titlize($prefix = '-') 
    {
        //argument 1 must be a string
        Eden_String_Argument::i()->test(1, 'string');

        $this->data = ucwords(str_replace($prefix, ' ', $this->data));

        return $this;
    }

    /**
     * Uncamelizes a string
     *
     * @param string $prefix The delimeter to look for
     *
     * @return Eden_String_Index
     */
    public function uncamelize($prefix = '-') 
    {
        //argument 1 must be a string
        Eden_String_Argument::i()->test(1, 'string');

        $this->data = strtolower(preg_replace("/([A-Z])/", $prefix."$1", $this->data));

        return $this;
    }

    /**
     * Summarizes a text
     *
     * @param *int $words Number of words
     *
     * @return Eden_String_Index
     */
    public function summarize($words) 
    {
        //argument 1 must be an integer
        Eden_String_Argument::i()->test(1, 'int');

        $this->data = explode(' ', strip_tags($this->data), $words);
        array_pop($this->data);
        $this->data = implode(' ', $this->data);

        return $this;
    }
    
    /**
     * A PHP method excepts arrays in 3 ways, first argument,
     * last argument and as a reference
     *
     * @param *string $name PHP method name
     *
     * @return string|false
     */
    protected function getMethod($name) 
    {
        if (isset(self::$_methods[$name])) {
            return $name;
        }

        if (isset(self::$_methods['str_'.$name])) {
            return 'str_'.$name;
        }
        
        $unspaced = str_replace('_', '', $name);
        
        if (isset(self::$_methods[$unspaced])) {
            return $unspaced;
        }
        
        if (isset(self::$_methods['str'.$unspaced])) {
            return 'str'.$unspaced;
        }
        
        $uncamel = strtolower(preg_replace("/([A-Z])/", "_$1", $name));

        if (isset(self::$_methods[$uncamel])) {
            return $uncamel;
        }

        if (isset(self::$_methods['str_'.$uncamel])) {
            return 'str_'.$uncamel;
        }
        
        $unspaced = str_replace('_', '', $uncamel);
        
        if (isset(self::$_methods[$unspaced])) {
            return $unspaced;
        }
        
        if (isset(self::$_methods['str'.$unspaced])) {
            return 'str'.$unspaced;
        }

        return $name;
    }

    /**
     * @var array $_methods The list of supported PHP methods
     */
    protected static $_methods = array(
        'addslashes' => self::PRE,
        'bin2hex' => self::PRE,
        'chunk_split' => self::PRE,
        'convert_uudecode' => self::PRE,
        'convert_uuencode' => self::PRE,
        'crypt' => self::PRE,
        'html_entity_decode' => self::PRE,
        'htmlentities' => self::PRE,
        'htmlspecialchars_decode' => self::PRE,
        'htmlspecialchars' => self::PRE,
        'lcfirst' => self::PRE,
        'ltrim' => self::PRE,
        'md5' => self::PRE,
        'nl2br' => self::PRE,
        'quoted_printable_decode' => self::PRE,
        'quoted_printable_encode' => self::PRE,
        'quotemeta' => self::PRE,
        'rtrim' => self::PRE,
        'sha1' => self::PRE,
        'sprintf' => self::PRE,
        'str_pad' => self::PRE,
        'str_repeat' => self::PRE,
        'str_rot13' => self::PRE,
        'str_shuffle' => self::PRE,
        'strip_tags' => self::PRE,
        'stripcslashes' => self::PRE,
        'stripslashes' => self::PRE,
        'strpbrk' => self::PRE,
        'stristr' => self::PRE,
        'strrev' => self::PRE,
        'strstr' => self::PRE,
        'strtok' => self::PRE,
        'strtolower' => self::PRE,
        'strtoupper' => self::PRE,
        'strtr' => self::PRE,
        'substr_replace' => self::PRE,
        'substr' => self::PRE,
        'trim' => self::PRE,
        'ucfirst' => self::PRE,
        'ucwords' => self::PRE,
        'vsprintf' => self::PRE,
        'wordwrap' => self::PRE,
        'count_chars' => self::PRE,
        'hex2bin' => self::PRE,
        'strlen' => self::PRE,
        'strpos' => self::PRE,
        'substr_compare' => self::PRE,
        'substr_count' => self::PRE,
        'str_ireplace' => self::POST,
        'str_replace' => self::POST,
        'preg_replace' => self::POST,
        'explode' => self::POST);
}
