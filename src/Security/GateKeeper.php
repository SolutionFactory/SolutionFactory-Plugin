<?php
/**
 * Allows or prevents access to certain admin methods
 *
 * PHP version 5.3
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Security
 * @author     SolutionFactory
 * @copyright  Copyright (c) 2014 SolutionFactory
 * @license    MIT (see LICENSE file)
 * @version    1.0.0
 */
namespace SolutionFactory\Plugin\Security;

use SolutionFactory\Plugin\I18n\Translator;

/**
 * Allows or prevents access to certain admin methods
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Security
 * @author     SolutionFactory
 */
class GateKeeper
{
    /**
     * @var \SolutionFactory\Plugin\I18n\Translator The translator
     */
    private $translator;

    /**
     * Creates instance
     *
     * @param \SolutionFactory\Plugin\I18n\Translator $translator Instance of the translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Prevent direct access to the plugin directory
     */
    public function preventDirectAccess()
    {
        if (!defined('ABSPATH')) {
            wp_die($this->translator->get('You do not have sufficient permissions to access this page.', true));
        }
    }
}
