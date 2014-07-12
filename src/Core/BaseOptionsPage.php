<?php
/**
 * Abstract class for options pages
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
 * Abstract class for options pages
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Core
 * @author     SolutionFactory
 */
abstract class BaseOptionsPage implements Options
{
    /**
     * Adds the option page
     */
    public function add()
    {
        if (!current_user_can('manage_options')) {
            wp_die($this->translator->get('You do not have sufficient permissions to access this page.', true));
        }
    }

    /**
     * Renders the option page
     */
    public function render()
    {
        if (!current_user_can('manage_options')) {
            wp_die($this->translator->get('You do not have sufficient permissions to access this page.', true));
        }
    }
}
