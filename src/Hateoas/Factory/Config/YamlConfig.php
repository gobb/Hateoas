<?php

namespace Hateoas\Factory\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class YamlConfig implements ConfigInterface
{
    private $config = array();

    public function __construct($file)
    {
        if (!file_exists($file)) {
            throw new \InvalidArgumentException(sprintf('The file "%s" does not exist', $file));
        }

        $config = Yaml::parse(file_get_contents($file));

        if (isset($config['hateoas'])) {
            $this->config = $config['hateoas'];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getResourceDefinitions()
    {
        return isset($this->config['resources']) ? $this->config['resources'] : array();
    }

    /**
     * {@inheritDoc}
     */
    public function getCollectionDefinitions()
    {
        return isset($this->config['collections']) ? $this->config['collections'] : array();
    }
}
