<?php

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class CalculatorController
{
    public function addition(Request $request)
    {
        $a = $request->getQueryParameters()['a'];
        $b = $request->getQueryParameters()['b'];

        return Response::success($a + $b, ['Content-Type' => 'text/plain']);
    }
}
