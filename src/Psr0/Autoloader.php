<?php
/**
 * PSR-0 Autoloader
 *
 * PHP version 5.3
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Psr0
 * @author     SolutionFactory
 * @copyright  Copyright (c) 2014 SolutionFactory
 * @license    MIT (see LICENSE file)
 * @version    1.0.0
 */
namespace SolutionFactory\Plugin\Psr0;

/**
 * PSR-0 Autoloader
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Psr0
 * @author     SolutionFactory
 */
class Autoloader
{
    /**
     * @var string The namespace prefix for this instance.
     */
    protected $namespace = '';

    /**
     * @var string The filesystem prefix to use for this instance
     */
    protected $path = '';

    /**
     * Build the instance of the autoloader
     *
     * @param string $namespace The prefixed namespace this instance will load
     * @param string $path      The filesystem path to the root of the namespace
     */
    public function __construct($namespace, $path)
    {
        $this->namespace = ltrim($namespace, '\\');
        $this->path      = rtrim($path, '/\\') . DIRECTORY_SEPARATOR;
    }

    /**
     * Try to load a class
     *
     * @param string $class The class name to load
     *
     * @return boolean If the loading was successful
     */
    public function load($class)
    {
        $class = ltrim($class, '\\');
        if (strpos($class, $this->namespace) === 0) {
            $nsparts   = $this->getNamespaceParts($class);
            $class     = array_pop($nsparts);
            $nsparts[] = '';
            $path      = $this->path . implode(DIRECTORY_SEPARATOR, $nsparts);
            $path     .= str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
            if (file_exists($path)) {
                require $path;

                return true;
            }
        }

        return false;
    }

    /**
     * Gets the namespace parts with the prefix of vendor and package removed
     *
     * @param string $class The FQCN
     *
     * @return array The namespace parts
     */
    private function getNamespaceParts($class)
    {
        $parts = explode('\\', $class);

        return array_slice($parts, 2);
    }

    /**
     * Register the autoloader to PHP
     *
     * @return boolean The status of the registration
     */
    public function register()
    {
        return spl_autoload_register(array($this, 'load'));
    }

    /**
     * Unregister the autoloader to PHP
     *
     * @return boolean The status of the unregistration
     */
    public function unregister()
    {
        return spl_autoload_unregister(array($this, 'load'));
    }
}
