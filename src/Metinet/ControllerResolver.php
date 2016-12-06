<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet;

use Metinet\Http\Request;

class ControllerResolver
{
    private $controllers = [];
    private $matcher;

    public function __construct(RouteMatcher $routeMatcher)
    {
        $this->matcher = $routeMatcher;
    }

    public function resolve(Request $request)
    {
        list($matchedController, $matchedAction) = explode(
            '::',
            $this->matcher->match($request)
        );

        foreach ($this->controllers as $controller) {
            if (get_class($controller) === $matchedController) {

                return [$controller, $matchedAction];
            }
        }

        throw new ControllerNotFound($matchedController);
    }

    public function addController($controllerInstance)
    {
        $this->controllers[] = $controllerInstance;
    }
}
