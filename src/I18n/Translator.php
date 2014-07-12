<?php
/**
 * Wrapper around WordPress I18n functions
 *
 * PHP version 5.3
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage I18n
 * @author     SolutionFactory
 * @copyright  Copyright (c) 2014 SolutionFactory
 * @license    MIT (see LICENSE file)
 * @version    1.0.0
 */
namespace SolutionFactory\Plugin\I18n;

use SolutionFactory\Plugin\Prefix\Parsable;

/**
 * Wrapper around WordPress I18n functions
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage I18n
 * @author     SolutionFactory
 */
class Translator
{
    /**
     * @var string The text domain to use
     */
    private $domain;

    /**
     * @var string The directory with the language files
     */
    private $directory;

    /**
     * Creates instance
     *
     * @param string      $domain    The text domain to use
     * @param null|string $directory The language directory
     */
    public function __construct($domain, $directory = null)
    {
        $this->domain = $domain;

        $this->setDirectory($directory);

        add_action('init', array($this, 'loadTextdomain'));
    }

    /**
     * Sets the language directory
     *
     * @param null|string $directory The directory of the languages
     */
    private function setDirectory($directory)
    {
        if ($directory === null) {
            $this->directory = __DIR__ . '/../../language';
        } else {
            $this->directory = $directory;
        }
    }

    /**
     * Loads the text domain of the plugin
     */
    public function loadTextdomain()
    {
        load_plugin_textdomain($this->domain, false, $this->directory);
    }

    /**
     * Gets a translated string
     *
     * @param string  $name   The key for which to find the translation
     * @param boolean $global Whether to find translations in the global text
     *                        domain instead of the plugin's text domain
     *
     * @return string The translated string
     */
    public function get($name, $global = false)
    {
        if ($global === true) {
            return __($name);
        }

        return __($name, $this->domain);
    }
}
