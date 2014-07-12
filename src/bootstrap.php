<?php
/**
 * Bootstraps the plugin framework
 *
 * PHP version 5.3
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @author     SolutionFactory
 * @copyright  Copyright (c) 2014 SolutionFactory
 * @license    MIT (see LICENSE file)
 * @version    1.0.0
 */
namespace SolutionFactory\Plugin;

use namespace SolutionFactory\Plugin\Psr0\Autoloader;

/**
 * Setup autoloading for the framework
 */
require_once __DIR__ . '/src/Psr0/Autoloader.php';
$autoloader = new Autoloader(__NAMESPACE__, __DIR__);
