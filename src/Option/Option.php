<?php
/**
 * Simple abstraction layer for handing plugin options
 *
 * PHP version 5.3
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Option
 * @author     SolutionFactory
 * @copyright  Copyright (c) 2014 SolutionFactory
 * @license    MIT (see LICENSE file)
 * @version    1.0.0
 */
namespace SolutionFactory\Plugin\Option;

use SolutionFactory\Plugin\Prefix\Parsable;

/**
 * Simple abstraction layer for handing plugin options
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Option
 * @author     SolutionFactory
 */
class Container implements Getter
{
    /**
     * @var \SolutionFactory\Plugin\Prefix\Parsable Instance of a namespace parser
     */
    private $namespace;

    /**
     * Creates instance
     *
     * @param \SolutionFactory\Plugin\Prefix\Parsable $namespace Instance of a namespace parser
     */
    public function __construct(Parsable $namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Gets an option value
     *
     * @param string $name The name of the option to get
     *
     * @return mixed The value of the option
     */
    public function get($name)
    {
        $value = get_option($this->namespace->get() . $name);

        return $this->parseOption();
    }

    /**
     * Parses an option retrieved from the database
     *
     * If the value if null return directly. If json_decode returns null it is
     * not valid JSON and we also return the raw value directly
     * Otherwise return the decoded JSOn
     *
     * @param null|string The value of the option as retrieved from the database
     */
    private function parseOption($value)
    {
        $parsed = json_decode($value, true);

        if ($value === null || $parsed === null) {
            return $value;
        }

        return $parsed;
    }
}
