<?php

namespace Phine\Example;

use DateTime;
use Exception;
use Phine\Example\Exception\ExampleException;

/**
 * Implements some of the basic `ExampleInterface` requirements.
 *
 * The implementation details for `Countable` and `IteratorAggregate` will
 * need to be implemented by the subclass for `AbstractExample`. The abstract
 * class will also delegate a new protected method, `doSetCreatedDate()`. This
 * method will do some conversion before setting, if applicable.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
abstract class AbstractExample implements ExampleInterface
{
    /**
     * The date and time the instance was created.
     *
     * @var DateTime
     */
    protected $created;

    /**
     * Sets the initial created date and time.
     */
    public function __construct()
    {
        $this->created = new DateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedDate()
    {
        return $this->created;
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedDate($created)
    {
        $this->doSetCreatedDate($created);
    }

    /**
     * Performs the actual process of setting the created date and time.
     *
     * - If an instance of DateTime is given, it will be used as is.
     * - If an integer value is given, it will be treated as a UTC Unix
     *   timestamp.
     *
     * @param DateTime|integer $created The date and time.
     *
     * @throws Exception
     * @throws ExampleException If $created is not an instance of `DateTime`
     *                          and is not an integer value. Numeric strings
     *                          will still strip an exception.
     *
     * @see DateTime Just because.
     */
    abstract protected function doSetCreatedDate($created);
}
