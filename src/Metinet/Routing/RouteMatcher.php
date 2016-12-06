<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Routing;

use Metinet\Http\Request;

class RouteMatcher
{
    private $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function match(Request $request)
    {
        /** @var Route $route */
        foreach ($this->routes as $route) {
            if ($route->getPath() === $request->getPath()
                && $route->getMethod() === $request->getMethod()
            ) {

                return $route->getAction();
            }
        }

        throw new RouteNotFound($request);
    }
}
