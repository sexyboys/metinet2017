<?php

namespace Metinet;

use Metinet\Http\Request;
use Metinet\Http\Response;


/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class CalculatorController
{
    private $base;
    public function __construct($base)
    {
        $this->base = $base;
    }

    public function addition(Request $request)
    {
        $a = $request->getQueryParameters()['a'];
        $b = $request->getQueryParameters()['b'];

        return Response::success(base_convert($a + $b, 10, $this->base), ['Content-Type' => 'text/plain']);
    }
}
