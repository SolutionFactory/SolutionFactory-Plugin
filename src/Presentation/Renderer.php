<?php
/**
 * Class which render tenplate files
 *
 * PHP version 5.3
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Presentation
 * @author     SolutionFactory
 * @copyright  Copyright (c) 2014 SolutionFactory
 * @license    MIT (see LICENSE file)
 * @version    1.0.0
 */
namespace SolutionFactory\Plugin\Presentation;

use SolutionFactory\Plugin\I18n\Translator;

/**
 * Class which render tenplate files
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Presentation
 * @author     SolutionFactory
 */
class Renderer
{
    /**
     * @var string The location of the template file to render
     */
    private $template;

    /**
     * @var array List of template variable
     */
    private $variables;

    /**
     * @var \SolutionFactory\Plugin\I18n\Translator Instance of the translator
     */
    private $translator;

    /**
     * Creates instance
     *
     * @param string                                  $template   The location of the template file to render
     * @param array                                   $data       The data used by the template
     * @param \SolutionFactory\Plugin\I18n\Translator $translator The translator
     */
    public function __construct($template, array $data, Translator $translator)
    {
        $this->template   = $template;
        $this->variables  = $data;
        $this->translator = $translator;
    }

    /**
     * Gets a template variable
     *
     * @param mixed $name The name of the variable to get
     *
     * @return mixed The value of the variable
     */
    public function __get($name)
    {
        return $this->variables[$name];
    }

    /**
     * Sets a template variable
     *
     * @param mixed $name  The name of the variable
     * @param mixed $value The value of the variable
     */
    public function __set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * Checks whether a template variable is set
     *
     * @param mixed $name The name of the variable to check
     *
     * @return boolean True when the variable is set
     */
    public function __isset($name)
    {
        return isset($this->variables[$name]);
    }

    /**
     * Renders the template
     *
     * @return string The rendered template
     */
    public function render()
    {
        ob_start();

        require $this->template;

        $html = ob_get_contents();

        ob_end_clean();

        return $html;
    }
}
