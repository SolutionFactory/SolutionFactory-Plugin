<?php
/**
 * Interface for namespace parser for plugin options
 *
 * PHP version 5.3
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Prefix
 * @author     SolutionFactory
 * @copyright  Copyright (c) 2014 SolutionFactory
 * @license    MIT (see LICENSE file)
 * @version    1.0.0
 */
namespace SolutionFactory\Plugin\Prefix;

/**
 * Interface for namespace parser for plugin options
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Prefix
 * @author     SolutionFactory
 */
interface Parsable
{
    /**
     * Gets the namespace used for the options based on a PHP namespace
     *
     * @param string $namespace The namespace to parse
     *
     * @return string The namespace for the options
     */
    public function get($namespace);
}
