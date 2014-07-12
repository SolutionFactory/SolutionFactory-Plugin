<?php
/**
 * Normalizes and parses PHP namespaces to be used in plugin options
 *
 * This method automatically gets the first n items from a PHP namespace.
 * E.g. \Some\Name\Space will be translated to some_name_
 * This is useful for namespacing WordPress options to prevent conflicts
 *
 * PHP version 5.3
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Prefix
 * @author     SolutionFactory
 * @copyright  Copyright (c) 2014 SolutionFactory
 * @license    MIT (see LICENSE file)
 * @version    1.0.0
 */
namespace SolutionFactory\Plugin\Prefix;

/**
 * Normalizes and parses PHP namespaces to be used in plugin options
 *
 * @category   SolutionFactory
 * @package    Plugin
 * @subpackage Prefix
 * @author     SolutionFactory
 */
class Parser implements Parsable
{
    /**
     * @var string The default namespace
     */
    private $namespace;

    /**
     * @var int The number of parts to use from the namespace
     */
    private $length;

    /**
     * Creates instance
     *
     * @param string $namespace The default namespace
     * @param int    $length    The number of parts to use from the namespace
     */
    public function __construct($namespace, $length = 2)
    {
        $this->namespace = $namespace;
        $this->length    = (int) $length;
    }

    /**
     * Gets the namespace used for the options based on a PHP namespace
     *
     * @param string $namespace The namespace to parse
     *
     * @return string The namespace for the options
     */
    public function get($namespace = null)
    {
        if ($namespace === null) {
            $namespace = $this->namespace;
        }

        $namespace = $this->normalizeNamespace($namespace);

        $parts = $this->getNamespaceParts($namespace);

        $parsedNamespace = '';
        for ($i = 0; $i < $this->length; $i++) {
            $parsedNamespace .= $parts[$i] . '_';
        }

        return $parsedNamespace;
    }

    /**
     * Normalizes the PHP namespace
     *
     * @param string $namespace The namespace to normalize
     */
    private function normalizeNamespace($namespace)
    {
        return trim($namespace, '\\');
    }

    /**
     * Splits the namespace into separate parts
     *
     * @param string $namespace The namespace to split
     *
     * @return array The namespace parts
     */
    private function getNamespaceParts($namespace)
    {
        return explode('\\', $namespace);
    }
}
