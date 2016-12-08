<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Http\Request;
use Metinet\Http\Response;

class ErrorController
{
    /**
     * @var \Exception
     */
    private $exception;

    public function setException(\Throwable $e)
    {
        $this->exception = $e;
    }

    public function genericError(Request $request)
    {
        $message = sprintf(
            "Une erreur est survenue: %s",
            $this->exception->getMessage()
        );

        return new Response(500, $message, []);
    }

    public function routeNotFound(Request $request)
    {
        $message = sprintf(
            "La page n'existe pas: %s",
            $this->exception->getMessage()
        );
        return Response::notFound($message, []);
    }
}
