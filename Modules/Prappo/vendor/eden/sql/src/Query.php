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
abstract class Query extends Base
{
    /**
     * Transform class to string using
     * getQuery
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getQuery();
    }
    
    /**
     * Returns the string version of the query
     *
     * @param bool
     *
     * @return string
     */
    abstract public function getQuery();
}
