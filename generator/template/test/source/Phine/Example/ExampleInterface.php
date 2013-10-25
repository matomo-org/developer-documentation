<?php

namespace Phine\Example;

use Countable;
use DateTime;
use IteratorAggregate;

/**
 * Defines how an example class must be implemented.
 *
 * The example interface also includes a long description to demonstrate what
 * it would look like inside of a Markdown file. After I added Markdown support
 * to Sami (1.1), any **Markdown** formatted text in a docblock should just end
 * up in the file.
 *
 * - This the first bullet in the list.
 * - This is the second in the same list.
 *     - This one is indented.
 *
 * ```php
 * use Phine\Example\ExampleInterface;
 *
 * class Example implements ExampleInterface
 * {
 * }
 * ```
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface ExampleInterface extends Countable, IteratorAggregate
{
    /**
     * Indicates an "off" state.
     *
     * This is an example long description for the `OFF` constant in the
     * `ExampleInterface` interface. Its primary purpose is to demonstrate
     * how a constant with _and_ without a long description would be shown
     * in the documentation generated.
     */
    const OFF = 0;

    /**
     * Indicates an "on" state.
     */
    const ON = 1;

    /**
     * Creates a new class instance and returns it.
     *
     * @return ExampleInterface The new class instance.
     */
    public static function create();

    /**
     * Returns the arguments set by `setArgs()`.
     *
     * @return array The arguments.
     */
    public function getArgs();

    /**
     * Returns the date and time this instance was created.
     *
     * @return DateTime The date and time.
     */
    public function getCreatedDate();

    /**
     * Sets a few arguments.
     *
     * This method exists primarily to test how PHP type hints are handled.
     *
     * @param boolean $boolean A boolean value.
     * @param integer $integer An integer value.
     * @param string  $string  A string value.
     *
     * @return ExampleInterface This instance.
     */
    public function setArgs($boolean, $integer, $string);

    /**
     * Sets the date and time this instance was created.
     *
     * If an `integer` value is provided instance of a `DateTime` instance, it
     * will be used as a Unix timestamp, and a new `DateTime` instance will be
     * created.
     *
     * @param DateTime|integer $created The date and time.
     */
    public function setCreatedDate($created);
}
