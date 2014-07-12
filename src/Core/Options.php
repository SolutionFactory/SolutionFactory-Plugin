<?php
/**
 * Interface for options pages
 *
 * PHP version 5.3
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Core
 * @author     SolutionFactory
 * @copyright  Copyright (c) 2014 SolutionFactory
 * @license    MIT (see LICENSE file)
 * @version    1.0.0
 */
namespace SolutionFactory\Plugin\Core;

/**
 * Interface for options pages
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Core
 * @author     SolutionFactory
 */
interface Options
{
    /**
     * Adds the option page
     */
    public function add();

    /**
     * Renders the option page
     */
    public function render();
}
