<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Model;

/**
 * Model class implementation
 *
 * @vendor   Eden
 * @package  Model
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Index extends Base
{
    /**
     * We are disallowing the PHP default functions
     * from being called
     *
     * @param string $name the name of the method
     *
     * @return string
     */
    protected function getMethod($name)
    {
        return $name;
    }
}
