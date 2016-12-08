<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet;

use Metinet\Http\Response;
use Metinet\Routing\RouteNotFound;

class ExceptionHandler
{
    private $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function handle(\Exception $exception)
    {
        $this->controller->setException($exception);

        if ($exception instanceof RouteNotFound) {

            return [$this->controller, 'routeNotFound'];
        }

        return [$this->controller, 'genericError'];
    }
}
