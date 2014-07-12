<?php
/**
 * Class which represents templates to render HTML
 *
 * When rendering templates this class will first look for template overrides
 * in the currenty active theme before trying to load the template from the
 * plugin's directory. This makes plugins easily extendable
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
 * Class which represents templates to render HTML
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Presentation
 * @author     SolutionFactory
 */
class Template
{
    /**
     * @var string The name of the plugin
     */
    private $pluginName;

    /**
     * @var string The plugin's template directory
     */
    private $directory;

    /**
     * @var \SolutionFactory\Plugin\I18n\Translator Instance of the translator
     */
    private $translator;

    /**
     * Creates instance
     *
     * @param string                                  $pluginName The name of the plugin
     * @param string                                  $directory  The plugin's template directory
     * @param \SolutionFactory\Plugin\I18n\Translator $translator The translator
     */
    public function __construct($pluginName, $directory, Translator $translator)
    {
        $this->pluginName = $pluginName;
        $this->directory  = $directory;
        $this->translator = $translator;
    }

    /**
     * Renders a template
     *
     * @param array  $data     The optional variables to pass to the template
     * @param string $template The template to render
     *
     * @return string The rendered template
     */
    public function render($template, array $data = array())
    {
        $renderer = new Renderer($this->getTemplate($template), $data, $this->translator);

        return $renderer->render();
    }

    /**
     * Gets the template file
     *
     * This method first checks for templates overrides in the currently active
     * theme. If not template override is found it returns the plugin's template
     *
     * @param string $template The template to find
     *
     * @return string The full path to the template
     */
    private function getTemplate($template)
    {
        if (file_exists(get_stylesheet_directory() . '/' . $this->pluginName . '/' . $template)) {
            return get_stylesheet_directory() . '/' . $this->pluginName . '/' . $template;
        }

        return $this->directory . '/' . $template;
    }
}
