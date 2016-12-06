<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Config;

class Configuration
{
    private $loader;
    private $config;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    public function getSection($section)
    {
        if (!$this->config) {
            $this->config = $this->loader->load();
        }

        if (!isset($this->config[$section])) {

            throw new \Exception(sprintf('Section "%s" not found', $section));
        }

        return $this->config[$section];
    }
}
