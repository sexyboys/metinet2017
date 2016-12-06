<?php

namespace Metinet\Routing;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class Route
{
    private $method;
    private $path;
    private $action;

    public function __construct($method, $path, $action)
    {
        $this->method = $method;
        $this->path   = $path;
        $this->action = $action;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getAction()
    {
        return $this->action;
    }
}
