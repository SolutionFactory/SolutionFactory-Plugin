<?php
/**
 * The base plugin class
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

use SolutionFactory\Plugin\Presentation\Template;
use SolutionFactory\Plugin\I18n\Translator;
use SolutionFactory\Plugin\Core\Options;

/**
 * The base plugin class
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Core
 * @author     SolutionFactory
 */
class Plugin
{
    /**
     * @var string The name of the plugin
     */
    private $name;

    /**
     * @var \SolutionFactory\Plugin\Presentation\Template The templating engine
     */
    private $template;

    /**
     * @var \SolutionFactory\Plugin\I18n\Translator The translator
     */
    private $translator;

    /**
     * List of admin scripts used
     */
    private $adminScripts = array();

    /**
     * List of admin stylesheets used
     */
    private $adminStyles = array();

    /**
     * Creates instance
     *
     * @param string                                        $name       The name of the plugin
     * @param \SolutionFactory\Plugin\Presentation\Template $template   The templating engine
     * @param \SolutionFactory\Plugin\I18n\Translator       $translator Instance of the translator
     */
    public function __construct($name, Template $template, Translator $translator)
    {
        $this->name       = $name;
        $this->template   = $template;
        $this->translator = $translator;

        $this->adminScripts = array(
            'admin' => '/resources/js/admin.js',
        );

        $this->adminStyles = array(
            'admin' => '/resources/style/admin.css',
        );
    }

    /**
     * Enables the options menu and page for the plugin
     */
    public function enableOptionsPage(Options $optionsPage)
    {
        add_action('admin_menu', array($optionsPage, 'add'));
    }

    /**
     * Enable the plugin's settings link on the plugin page
     */
    public function enableSettingsLink()
    {
        add_filter('plugin_action_links_' . $this->name . '/' . $this->name . '.php', array($this, 'addSettingsLink'));
    }

    /**
     * Adds extra admin scripts
     *
     * @param string $name The name of the handle
     * @param string $file The filename
     */
    public function addAdminScript($name, $file)
    {
        $this->adminScripts[$name] = $file;
    }

    /**
     * Adds extra admin stylesheets
     *
     * @param string $name The name of the handle
     * @param string $file The filename
     */
    public function addAdminStyle($name, $file)
    {
        $this->adminStyles[$name] = $file;
    }

    /**
     * Runs the plugin
     */
    public function run()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueAdminResources'));
    }

    /**
     * Adds the settings link in the admin on the plugin page
     *
     * @param array $links The current list of plugin links
     *
     * @return array The list of plugin links including the settings link
     */
    public function addSettingsLink(array $links)
    {
        $links[] = $this->template->render('admin/settings-link.phtml', array('pluginName' => $this->name));

        return $links;
    }

    /**
     * Enqueues all the admin resources
     */
    public function enqueueAdminResources()
    {
        wp_enqueue_script('jquery-ui-sortable');

        foreach ($this->adminScripts as $name => $filename) {
            wp_enqueue_script($this->name . $name, plugins_url($this->name) . $filename);
        }

        foreach ($this->adminStyles as $name => $filename) {
            wp_enqueue_style($this->name . $name, plugins_url($this->name) . $filename);
        }
    }
}
