<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

$calculatorController = new CalculatorController();

if ('GET' === $request->getMethod() && $request->getPath() === '/calculator/addition') {
    $response = $calculatorController->addition($request);
    $response->send();
}
