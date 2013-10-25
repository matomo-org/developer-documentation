<?php

namespace Phine\Example;

use ArrayIterator;
use DateTime;
use Phine\Example\Exception\ExampleException;

/**
 * This is an example class that fills in the blanks left by `AbstractExample`.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
final class Example extends AbstractExample
{
    /**
     * The "on" or "off" flag.
     *
     * This property accepts either the `ON` or `OFF` constants from the
     * `ExampleInterface` interface. It also solely exists to demonstrate
     * what a long description for a property will look like in the
     * documentation.
     *
     * @var boolean[]|integer
     */
    public $state;

    /**
     * The arguments provided.
     *
     * @var array
     */
    private $args = array(null, null, null);

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return 123;
    }

    /**
     * {@inheritDoc}
     */
    final public static function create()
    {
        return new self();
    }

    /**
     * {@inheritDoc}
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * Returns an array of `DateTime` instances.
     *
     * @return DateTime[] The dates.
     */
    public function getDates()
    {
        return array(
            new DateTime(),
            new DateTime(),
            new DateTime(),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new ArrayIterator(array());
    }

    /**
     * Returns a random argument.
     *
     * @return boolean|integer|string A random argument.
     */
    public function getRandom()
    {
        return $this->args[rand(0, count($this->args) - 1)];
    }

    /**
     * {@inheritDoc}
     */
    public function setArgs($boolean, $integer, $string)
    {
        $this->args = array($boolean, $integer, $string);
    }

    /**
     * {@inheritDoc}
     */
    protected function doSetCreatedDate($created)
    {
        if (is_integer($created)) {
            $created = new DateTime("@$created");
        } elseif (!($created instanceof DateTime)) {
            throw new ExampleException(
                '$created must be an integer or instance of DateTime.'
            );
        }

        $this->created = $created;
    }
}
