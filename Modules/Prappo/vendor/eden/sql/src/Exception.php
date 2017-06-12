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
 * Exception Class
 *
 * @vendor   Eden
 * @package  Sql
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Exception extends \Eden\Core\Exception
{
    /**
     * @const string QUERY_ERROR Error template
     */
    const QUERY_ERROR = '%s Query: %s';

    /**
     * @const string TABLE_NOT_SET Error template
     */
    const TABLE_NOT_SET = 'No default table set or was passed.';

    /**
     * @const string DATABASE_NOT_SET Error template
     */
    const DATABASE_NOT_SET = 'No default database set or was passed.';

    /**
     * @const string NOT_SUB_MODEL Error template
     */
    const NOT_SUB_MODEL = 'Class %s is not a child of Eden\\Model\\Index';

    /**
     * @const string NOT_SUB_COLLECTION Error template
     */
    const NOT_SUB_COLLECTION = 'Class %s is not a child of Eden\\Collection\\Index';
}
