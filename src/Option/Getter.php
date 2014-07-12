<?php
/**
 * Interface for option getters
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

/**
 * Interface for option getters
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Option
 * @author     SolutionFactory
 */
interface Getter
{
    /**
     * Gets an option value
     *
     * @param string $name The name of the option to get
     *
     * @return mixed The value of the option
     */
    public function get($name);
}
