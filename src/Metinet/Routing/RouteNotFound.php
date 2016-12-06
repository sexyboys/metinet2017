<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Routing;

use Metinet\Http\Request;

class RouteNotFound extends \Exception
{
    public function __construct(Request $request)
    {
        parent::__construct(
            sprintf(
                "La route '%s' associée à la méthode '%s' n'existe pas",
                $request->getPath(),
                $request->getMethod()
            )
        );
    }
}
